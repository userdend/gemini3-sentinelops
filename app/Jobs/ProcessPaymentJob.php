<?php

namespace App\Jobs;

use App\Events\ActiveJobsUpdated;
use App\Models\ChaosProfile;
use App\Models\FailureLog;
use App\Services\Chaos;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected ChaosProfile $profile;

    public function __construct(
        ChaosProfile $profile
    ) {
        $this->profile = $profile;
    }

    public function handle(Chaos $chaos)
    {
        $chaos = new Chaos($this->profile);
        $response = null;

        $delay = rand(5, 15);
        sleep($delay);

        try {
            $chaos->injectLatency();
            $chaos->maybeDropPacket();
            $chaos->enforceMemoryLimit();

            $response = Http::timeout(
                $chaos->dependencyTimeoutSeconds()
            )->get('https://httpstat.us/504');

            if ($response->failed()) {
                throw new \RuntimeException('Bank API timeout');
            }

        } catch (\Throwable $e) {

            FailureLog::create(array_merge([
                'job' => self::class,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'http_status' => $response ? $response->status() : null,
                'retry_count' => $this->attempts(),
                'stack_trace' => substr($e->getTraceAsString(), 0, 5000),
            ], $chaos->snapshot()));

            throw $e;
        }
    }
}
