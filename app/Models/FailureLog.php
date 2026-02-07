<?php

// app/Models/FailureLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailureLog extends Model
{
    protected $table = 'failure_logs';

    protected $fillable = [
        'job',
        'error',
        'exception',
        'http_status',
        'retry_count',
        'latency_ms',
        'memory_limit_mb',
        'dependency_timeout_ms',
        'stack_trace',
        'status'
    ];
}
