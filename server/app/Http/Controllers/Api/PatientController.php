<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SinglePatientResource;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            'birth' => 'required|date',
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
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
            'status' => 'success',
            'access_token' => $accessToken
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'description' => 'required|string',
            'birth' => 'required|date',
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
