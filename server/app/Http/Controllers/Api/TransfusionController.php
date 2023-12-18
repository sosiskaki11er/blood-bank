<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Transfusion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransfusionController extends Controller
{
    public function donorIndex()
    {
        $transfusions = Transfusion::where('donor_guid', auth()->user()->guid)->get();

        return response()->json([
            'status' => 'success',
            'data' => $transfusions
        ]);
    }
    public function index(Request $request)
    {
        $transfusions = Transfusion::where('hospital_guid', $request->hospital_guid)->get();

        return response()->json([
            'status' => 'success',
            'data' => $transfusions
        ]);
    }
    public function show($guid): JsonResponse
    {
        $transfusion = Transfusion::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'data' => $transfusion
        ]);
    }

    public function create(): JsonResponse
    {
        $data = request()->validate([
            'date' => 'required',
            'time' => 'required',
            'hospital_guid' => 'required',
            'type' => 'required',
        ]);

        $data['time'] = str_replace(';', ':', $data['time']);

        $data['donor_guid'] = auth()->user()->guid;
        $data['status'] = 0;
        $transfusion = Transfusion::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $transfusion
        ]);
    }

    public function setStatus($guid): JsonResponse
    {
        $data = request()->validate([
            'status' => 'required|in:0,1,2',
            'amount' => 'required:max:0.450',
        ]);

        $transfusion = Transfusion::where('guid', $guid)->first();

        $transfusion->update($data);

        if ($transfusion->status == 1) {
            $bloodBank = BloodBank::where('hospital_guid', $transfusion->hospital_guid)->where('blood_type', $transfusion->donor->blood_type . $transfusion->donor->blood_rh)->first();
            $bloodBank->amount = $bloodBank->amount + $data['amount'];
            $bloodBank->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => BloodBank::where('hospital_guid', $transfusion->hospital_guid)->where('blood_type', $transfusion->donor->blood_type . $transfusion->donor->blood_rh)->first()
        ]);
    }


}
