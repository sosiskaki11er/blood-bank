<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use Illuminate\Http\Request;

class BloodBankController extends Controller
{
    public function index()
    {
        $bloodBanks = BloodBank::all();
        return response()->json([
            'status' => 'success',
            'data' => $bloodBanks
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required',
            'blood_type' => 'required',
            'amount' => 'required',
        ]);
        $bloodBank = new BloodBank();
        $bloodBank->guid = uuid_create(UUID_TYPE_RANDOM);
        $bloodBank->hospital_id = $request->hospital_id;
        $bloodBank->blood_type = $request->blood_type;
        $bloodBank->amount = $request->amount;
        $bloodBank->save();

        return response()->json([
            'status' => 'success',
            'data' => $bloodBank
        ]);
    }

    public function show(Request $request)
    {
        $bloodBank = BloodBank::where('guid', $request->guid)->first();
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
