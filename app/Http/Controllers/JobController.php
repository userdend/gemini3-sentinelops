<?php

namespace App\Http\Controllers;

use App\Models\FailureLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobController extends Controller
{
    public function activeJobsCount()
    {
        $count = Queue::size('default');

        return response()->json([
            'count' => $count
        ]);
    }

    public function failedJobsCount()
    {
        $count = FailureLog::where('status', 'open')->count();

        return response()->json([
            'count' => $count
        ]);
    }

    public function failureLogs()
    {
        $logs = FailureLog::orderBy('created_at', 'desc')
            ->where('status', 'open')
            ->take(5)
            ->get();

        $logs = $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'job' => $log->job,
                'error' => $log->error,
                'exception' => $log->exception,
                'status' => $log->status,
                'created_at' => Carbon::parse($log->created_at)->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json($logs);
    }

    public function incidentLogs()
    {
        $logs = FailureLog::orderBy('created_at', 'desc')
            ->where('status', 'open')
            ->get();

        $logs = $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'job' => $log->job,
                'error' => $log->error,
                'exception' => $log->exception,
                'status' => $log->status,
                'created_at' => Carbon::parse($log->created_at)->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json($logs);
    }

    public function resolveManually(Request $request)
    {
        $id = $request->input('id');
        try {
            DB::beginTransaction();
            FailureLog::where('id', $id)
                ->update(['status' => 'resolved']);
            DB::commit();
            return response()->json(200);
        } catch (\Exception $e) {
            return response()->json(500);
        }
    }



    public function resolvedIncidentLogs()
    {
        $logs = FailureLog::orderBy('created_at', 'desc')
            ->where('status', 'resolved')
            ->get();

        $logs = $logs->map(function ($log) {
            return [
                'id' => $log->id,
                'job' => $log->job,
                'error' => $log->error,
                'exception' => $log->exception,
                'status' => $log->status,
                'created_at' => Carbon::parse($log->created_at)->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json($logs);
    }
}
