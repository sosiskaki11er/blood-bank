<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SingleDonorResource;
use App\Models\Donor;
use App\Models\HospitalHead;
use App\Models\Nurse;
use App\Models\Transfusion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DonorController extends Controller
{
    public function index(): JsonResponse
    {
        $donors = Donor::all();

        return response()->json([
            'status' => 'success',
            'data' => $donors
        ]);
    }

    public function register(): JsonResponse
    {
        $data = request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
            'blood_type' => 'nullable',
            'blood_rh' => 'nullable',
            'blood_disease' => 'nullable',
            'birth' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        $donor = Donor::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function addBloodType($guid): JsonResponse
    {
        $data = request()->validate([
            'blood_type' => 'required|in:A,B,AB,O',
            'blood_rh' => 'required|in:+,-',
            'blood_disease' => 'nullable',
        ]);

        $donor = Donor::where('guid', $guid)->first();

        $donor->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $donor = Donor::where('phone', $data['phone'])->first();

        if (!$donor || !Hash::check($data['password'], $donor->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        $token = $donor->createToken('donor-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'data' => $donor,
            'token' => $token
        ]);
    }


    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Donor logged out'
        ]);
    }

    public function show($guid): JsonResponse
    {
        $donor = Donor::where('guid', $guid)->first();

        $donor = new SingleDonorResource($donor);
        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function update($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            'birth' => 'nullable',
        ]);

        $donor = Donor::where('guid', $guid)->first();

        $donor->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function adminUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            'birth' => 'nullable',
            'blood_type' => 'nullable',
            'blood_rh' => 'nullable',
            'blood_disease' => 'nullable',
            'amount_of_money' => 'nullable',
        ]);

        $donor = Donor::where('guid', $guid)->first();

        $donor->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function destroy($guid): JsonResponse
    {
        $donor = Donor::where('guid', $guid)->first();

        $donor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Donor deleted'
        ]);
    }
}
