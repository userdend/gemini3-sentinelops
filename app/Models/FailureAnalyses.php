<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailureAnalyses extends Model
{
    protected $table = 'failure_analyses';

    protected $fillable = [
        'failure_log_id',
        'root_cause',
        'contributing_factors',
        'mitigation',
        'prevention',
    ];

    protected $casts = [
        'contributing_factors' => 'array',
        'mitigation' => 'array',
        'prevention' => 'array',
    ];

    public function failureLog()
    {
        return $this->belongsTo(FailureLog::class);
    }
}
