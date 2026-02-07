<?php

namespace App\Http\Controllers;

use App\Models\FailureLog;
use Illuminate\Http\Request;

class IncidentAgentController extends Controller
{
    public function list()
    {
        return view('incident-agent.list');
    }
}
