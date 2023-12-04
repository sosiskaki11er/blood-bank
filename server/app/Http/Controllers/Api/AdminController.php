<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('phone', $data['phone'])->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in',
            'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        auth()->guard('sanctum')->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    public function doctorsIndex(): JsonResponse
    {
        $doctors = Admin::all();

        return response()->json([
            'status' => 'success',
            'data' => $doctors
        ]);
    }

    public function doctorShow($guid): JsonResponse
    {
        $doctor = Admin::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ]);
    }

public function doctorUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $doctor = Admin::where('guid', $guid)->first();
        $doctor->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ]);
    }

    public function doctorDelete($guid): JsonResponse
    {
        $doctor = Admin::where('guid', $guid)->first();
        $doctor->delete();

        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ]);
    }

    public function patientIndex(): JsonResponse
    {
        $patients = Admin::all();

        return response()->json([
            'status' => 'success',
            'data' => $patients
        ]);
    }

    public function patientShow($guid): JsonResponse
    {
        $patient = Admin::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'data' => $patient
        ]);
    }

    public function patientUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $patient = Admin::where('guid', $guid)->first();
        $patient->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $patient
        ]);
    }

    public function patientDelete($guid): JsonResponse
    {
        $patient = Admin::where('guid', $guid)->first();
        $patient->delete();

        return response()->json([
            'status' => 'success',
            'data' => $patient
        ]);
    }

    public function donorIndex(): JsonResponse
    {
        $donors = Admin::all();

        return response()->json([
            'status' => 'success',
            'data' => $donors
        ]);
    }

    public function donorShow($guid): JsonResponse
    {
        $donor = Admin::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function donorUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $donor = Admin::where('guid', $guid)->first();
        $donor->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }

    public function donorDelete($guid): JsonResponse
    {
        $donor = Admin::where('guid', $guid)->first();
        $donor->delete();

        return response()->json([
            'status' => 'success',
            'data' => $donor
        ]);
    }
}
