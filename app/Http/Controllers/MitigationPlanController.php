<?php

namespace App\Http\Controllers;

use App\Models\FailureAnalyses;
use App\Models\FailureLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MitigationPlanController extends Controller
{
    public function list()
    {
        $plans = FailureAnalyses::whereHas('failureLog', fn($q) => $q->where('status', 'analyzed'))
            ->get();

        return view('mitigation-plan.list', compact('plans'));
    }

    public function resolved(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            FailureLog::where('id', $id)
                ->update([
                    'status' => 'resolved'
                ]);
            DB::commit();
            Alert::success('Success', 'Incident marked as resolved!');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong!');
        }

        return redirect()->back();
    }

    public function escalated(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            FailureLog::where('id', $id)
                ->update([
                    'status' => 'escalated'
                ]);
            DB::commit();
            Alert::success('Success', 'Incident marked as resolved!');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong!');
        }

        return redirect()->back();
    }
}
