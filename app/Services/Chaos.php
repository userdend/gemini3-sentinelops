<?php

namespace App\Services;

use App\Models\ChaosProfile;

class Chaos
{
    public function __construct(
        protected ChaosProfile $profile
    ) {
    }

    public function injectLatency(): void
    {
        if ($this->profile->latency_ms > 0) {
            usleep($this->profile->latency_ms * 1000);
        }
    }

    public function maybeDropPacket(): void
    {
        if (rand(1, 100) <= $this->profile->packet_loss_percent) {
            throw new \RuntimeException('Simulated network packet loss');
        }
    }

    public function enforceMemoryLimit(): void
    {
        if ($this->profile->memory_limit_mb < 256) {
            throw new \RuntimeException('Out of memory');
        }
    }

    public function dependencyTimeoutSeconds(): float
    {
        return $this->profile->dependency_timeout_ms / 1000;
    }

    public function snapshot(): array
    {
        return [
            'latency_ms' => $this->profile->latency_ms,
            'memory_limit_mb' => $this->profile->memory_limit_mb,
            'dependency_timeout_ms' => $this->profile->dependency_timeout_ms,
        ];
    }
}
