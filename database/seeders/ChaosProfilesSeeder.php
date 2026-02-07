<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChaosProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chaos_profiles')->insert([
            [
                'name' => 'No Chaos',
                'latency_ms' => 0,
                'packet_loss_percent' => 0,
                'memory_limit_mb' => null,
                'cpu_throttle_percent' => 0,
                'dependency_timeout_ms' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'High Latency',
                'latency_ms' => 500,
                'packet_loss_percent' => 0,
                'memory_limit_mb' => null,
                'cpu_throttle_percent' => 0,
                'dependency_timeout_ms' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Packet Loss',
                'latency_ms' => 50,
                'packet_loss_percent' => 10,
                'memory_limit_mb' => null,
                'cpu_throttle_percent' => 0,
                'dependency_timeout_ms' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Memory Constrained',
                'latency_ms' => 0,
                'packet_loss_percent' => 0,
                'memory_limit_mb' => 256,
                'cpu_throttle_percent' => 0,
                'dependency_timeout_ms' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CPU Throttle & Timeout',
                'latency_ms' => 100,
                'packet_loss_percent' => 5,
                'memory_limit_mb' => null,
                'cpu_throttle_percent' => 50,
                'dependency_timeout_ms' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
