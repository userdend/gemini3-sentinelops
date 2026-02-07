<?php

namespace App\Http\Controllers;

use App\Models\FailureLog;
use Illuminate\Http\Request;

class EscalatedIncidentController extends Controller
{
    public function list()
    {
        $escalatedLogs = FailureLog::where('status', 'escalated')->get();
        return view('escalated.list', compact('escalatedLogs'));
    }
}
