<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPaymentJob;
use App\Models\ChaosProfile;
use Illuminate\Http\Request;

class MyAppController extends Controller
{
    public function show()
    {
        $profiles = ChaosProfile::all();

        return view('my-app.show', compact('profiles'));
    }

    public function dispatch(Request $request)
    {
        $id = $request->input('id');
        $profile = ChaosProfile::find($id);
        ProcessPaymentJob::dispatch($profile);
        return response()->json([
            'status' => 'success',
            'data' => $profile
        ]);
    }
}
