<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Infusion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InfusionController extends Controller
{
    public function patientIndex(): JsonResponse
    {
        $infusions = Infusion::where('patient_guid', auth()->user()->guid)->get();

        return response()->json([
            'status' => 'success',
            'data' => $infusions
        ]);
    }

    public function index(): JsonResponse
    {
        $infusions = Infusion::where('doctor_guid', auth()->user()->guid)->get();

        return response()->json([
            'status' => 'success',
            'data' => $infusions
        ]);
    }

    public function show($guid): JsonResponse
    {
        $infusion = Infusion::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'data' => $infusion
        ]);
    }

    public function create(): JsonResponse
    {
        $data = request()->validate([
            'date' => 'required',
            'time' => 'required',
            'hospital_guid' => 'required',
            'doctor_guid' => 'required',
            'patient_guid' => 'nullable',
        ]);

        $data['time'] = str_replace(';', ':', $data['time']);
        $data['patient_guid'] = auth()->user()->guid;

        if($data['date'] < date('Y-m-d'))
        {
            return response()->json([
                'status' => 'error',
                'data' => 'date must be in the future'
            ]);
        }

        $infusion = Infusion::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $infusion
        ]);
    }

    public function update($guid): JsonResponse
    {
        $data = request()->validate([
            'status' => 'required|in:1,2',
            'amount' => 'required',
        ]);

        $infusion = Infusion::where('guid', $guid)->first();

        if($data['status'] == 1)
        {
            $bloodBank = BloodBank::where('hospital_guid', $infusion->hospital_guid)->where('blood_type', $infusion->patient->blood_type . $infusion->patient->blood_rh)->first();
            if ($bloodBank->amount - $data['amount'] < 0)
            {
                return response()->json([
                    'status' => 'error',
                    'data' => 'amount of infusion more than blood bank amount'
                ]);
            }
        $infusion->update($data);


        $bloodBank->amount = $bloodBank->amount - $infusion->amount;
        $bloodBank->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => $infusion
        ]);
    }

    public function delete($guid): JsonResponse
    {
        $infusion = Infusion::where('guid', $guid)->first();

        $infusion->delete();

        return response()->json([
            'status' => 'success',
            'data' => $infusion
        ]);
    }
}
