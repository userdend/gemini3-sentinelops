<?php

namespace App\Http\Controllers;

use App\Models\FailureLog;
use Illuminate\Http\Request;

class ResolvedIncidentController extends Controller
{
    public function list()
    {
        $resolvedLogs = FailureLog::where('status', 'resolved')
            ->get();
        return view('resolved.list', compact('resolvedLogs'));
    }
}
