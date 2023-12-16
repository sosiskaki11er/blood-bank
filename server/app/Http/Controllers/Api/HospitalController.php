<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Hospital;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HospitalController extends Controller
{
    public function index(): JsonResponse
    {
        $hospitals = Hospital::all();
        return response()->json([
            'status' => 'success',
            'data' => $hospitals
        ]);
    }

    public function show(Request $request): JsonResponse
    {
        $hospital = Hospital::where('guid', $request->guid)->first();
        return response()->json([
            'status' => 'success',
            'data' => $hospital
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $data = request()->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $hospital = Hospital::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $hospital
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'phone'=> 'nullable',
            'address' => 'nullable',
            'email' => 'nullable',
        ]);

        $hospital = Hospital::where('guid', $request->guid)->first();
        $hospital->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $hospital
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $hospital = Hospital::where('guid', $request->guid)->first();
        $hospital->delete();
        return response()->json([
            'status' => 'success',
            'data' => $hospital
        ]);
    }
}
