<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SinglePatientResource;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index(): JsonResponse
    {
        $patients = Patient::all();

        return response()->json([
            'status' => 'success',
            'patients' => $patients
        ]);
    }

    public function show($guid): JsonResponse
    {
        $patient = Patient::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:patients',
            'password' => 'required|string',
            'blood_type' => 'nullable|string',
            'blood_rh' => 'nullable|string',
            'blood_disease' => 'nullable|string',
            'doctor_guid' => 'nullable|uuid',
            'birth' => 'required',
        ]);
        $data['password'] = bcrypt($data['password']);

        $patient = Patient::create($data);

        return response()->json([
            'status' => 'success',
            'patient' => $patient
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'phone' => 'required',
            'password' => 'required|string',
        ]);

        $patient = Patient::where('phone', $data['phone'])->first();

        if (!$patient || !Hash::check($data['password'], $patient->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $patient->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }

    public function addDoctor($guid): JsonResponse
    {
        $data = request()->validate([
            'doctor_guid' => 'required',
        ]);

        $patient = Patient::where('guid', $guid)->first();

        $patient->update($data);
        $patient = new SinglePatientResource($patient);
        return response()->json([
            'status' => 'success',
            'data' => $patient
        ]);
    }

public function update($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable|string',
            'surname' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string',
            'birth' => 'nullable|date',
            'blood_type' => 'nullable|string',
            'blood_rh' => 'nullable|string',
            'blood_disease' => 'nullable|string',
            'doctor_guid' => 'nullable|uuid',
        ]);

        $patient = Patient::where('guid', $guid)->first();

        $patient->update($data);
        $patient = new SinglePatientResource($patient);
        return response()->json([
            'status' => 'success',
            'data' => $patient
        ]);
    }

    public function destroy($guid): JsonResponse
    {
        $patient = Patient::where('guid', $guid)->first();

        $patient->delete();

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Patient deleted'
        ]);
    }
}
