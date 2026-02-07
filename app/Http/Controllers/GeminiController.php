<?php

namespace App\Http\Controllers;

use App\Models\FailureAnalyses;
use App\Models\FailureLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Enums\ResponseMimeType;
use Illuminate\Support\Str;
use Gemini\Data\Content;
use Gemini\Data\GenerationConfig;
use Gemini\Data\Schema;
use Gemini\Enums\DataType;

class GeminiController extends Controller
{
    public function scan(Request $request)
    {
        $logId = $request->input('id');
        $query = FailureLog::query();

        if (!empty($logId)) {
            $query->where('id', $logId);
        } else {
            $query->where('status', 'open')->limit(5);
        }

        $logs = $query->get();

        $schema = [
            'type' => 'object',
            'properties' => [
                'root_cause' => ['type' => 'string'],
                'contributing_factors' => ['type' => 'array', 'items' => ['type' => 'string']],
                'mitigation' => ['type' => 'array', 'items' => ['type' => 'string']],
                'prevention' => ['type' => 'array', 'items' => ['type' => 'string']],
            ],
            'required' => ['root_cause', 'contributing_factors', 'mitigation', 'prevention']
        ];

        $model = Gemini::generativeModel('gemini-3-flash-preview')
            ->withSystemInstruction(Content::parse('You are an expert DevOps and Software Engineer. Analyze error logs and return structured JSON analysis.'))
            ->withGenerationConfig(new GenerationConfig(
                responseMimeType: ResponseMimeType::APPLICATION_JSON,
                responseSchema: new Schema(
                    type: DataType::OBJECT,
                    properties: [
                        'root_cause' => new Schema(
                            type: DataType::STRING,
                        ),
                        'contributing_factors' => new Schema(
                            type: DataType::ARRAY ,
                            items: new Schema(type: DataType::STRING)
                        ),
                        'mitigation' => new Schema(
                            type: DataType::ARRAY ,
                            items: new Schema(type: DataType::STRING)
                        ),
                        'prevention' => new Schema(
                            type: DataType::ARRAY ,
                            items: new Schema(type: DataType::STRING)
                        ),
                    ],
                    required: ['root_cause', 'contributing_factors', 'mitigation', 'prevention']
                ),
            ));

        $results = $logs->map(function ($log) use ($model) {
            try {
                // Limit stack trace to first 4000 chars to save tokens/costs
                $safeStackTrace = Str::limit($log->stack_trace, 4000);

                $prompt = "Error: {$log->error}\n";
                $prompt .= "Stack Trace: {$safeStackTrace}\n";
                $prompt .= "Exception: {$log->exception}";

                $response = $model->generateContent($prompt);

                // With Gemini 3 and response_schema, this is guaranteed to be JSON
                $analysis = json_decode($response->text(), true);

                if (!$analysis) {
                    throw new \Exception('AI returned an empty or invalid structure');
                }

                // Use a Transaction to ensure both updates happen or neither happens
                return DB::transaction(function () use ($log, $analysis) {
                    $failureAnalysis = FailureAnalyses::create([
                        'failure_log_id' => $log->id,
                        'root_cause' => $analysis['root_cause'],
                        'contributing_factors' => $analysis['contributing_factors'],
                        'mitigation' => $analysis['mitigation'],
                        'prevention' => $analysis['prevention'],
                    ]);

                    $failureAnalysis->failureLog->update(['status' => 'analyzed']);

                    return [
                        'failure_id' => $log->id,
                        'analysis_id' => $failureAnalysis->id,
                        'analysis' => $analysis,
                        'stored' => true
                    ];
                });

            } catch (\Exception $e) {
                Log::error('Gemini Analysis Error', [
                    'log_id' => $log->id,
                    'message' => $e->getMessage()
                ]);

                return $this->createFailedAnalysis($log, $e->getMessage());
            }
        });

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }

    private function createFailedAnalysis($log, $reason)
    {
        return [
            'failure_id' => $log->id,
            'analysis' => [
                'root_cause' => "Analysis failed: {$reason}",
                'contributing_factors' => [],
                'mitigation' => [],
                'prevention' => [],
            ],
            'stored' => false,
            'error_reason' => $reason
        ];
    }
}
