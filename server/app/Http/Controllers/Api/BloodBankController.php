<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BloodBankResource;
use App\Models\BloodBank;
use Illuminate\Http\Request;

class BloodBankController extends Controller
{
    public function index()
    {
        $bloodBanks = BloodBank::all();
        $bloodBanks = new BloodBanksResource($bloodBanks);
        return response()->json([
            'status' => 'success',
            'data' => $bloodBanks
        ]);
    }

    public function show(Request $request)
    {
        $bloodBank = BloodBank::where('hospital_guid', $request->guid)->get();

        $bloodBank = $bloodBank->map(function ($bloodBank) {
            return [
                'blood_type' => $bloodBank->blood_type,
                'amount' => $bloodBank->amount,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $bloodBank
        ]);
    }

    public function update(Request $request)
    {
        $bloodBank = BloodBank::where('guid', $request->guid)->first();
        if ($request->hospital_id)
            $bloodBank->hospital_id = $request->hospital_id;
        if ($request->blood_type)
            $bloodBank->blood_type = $request->blood_type;
        if ($request->amount)
            $bloodBank->amount = $request->amount;
        $bloodBank->save();

        return response()->json([
            'status' => 'success',
            'data' => $bloodBank
        ]);
    }

    public function destroy(Request $request)
    {
        $bloodBank = BloodBank::where('guid', $request->guid)->first();
        $bloodBank->delete();

        return response()->json([
            'status' => 'success',
            'data' => $bloodBank
        ]);
    }
}
