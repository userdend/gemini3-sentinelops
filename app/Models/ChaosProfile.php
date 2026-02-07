<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChaosProfile extends Model
{
    protected $table = 'chaos_profiles';

    protected $fillable = [
        'name',
        'latency_ms',
        'packet_loss_percent',
        'memory_limit_mb',
        'cpu_throttle_percent',
        'dependency_timeout_ms',
    ];

    public static function current(): self
    {
        return self::firstOrFail();
    }
}