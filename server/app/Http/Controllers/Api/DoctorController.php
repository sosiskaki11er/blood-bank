<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorForDonorResource;
use App\Http\Resources\SingleDoctorResource;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index(): JsonResponse
    {
        $doctors = Doctor::all();

        return response()->json([
            'status' => 'success',
            'data' => $doctors
        ]);
    }

    public function show($guid): JsonResponse
    {
        $doctor = Doctor::where('guid', $guid)->first();

        $doctor = new SingleDoctorResource($doctor);

        return response()->json([
            'status' => 'success',
            'data' => $doctor,
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
            'description' => 'nullable',
            'birth' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);

        $doctor = Doctor::create($data);

        $doctor->assignRole('doctor');

        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ]);
    }

    public function addHospital($guid): JsonResponse
    {
        $data = request()->validate([
            'hospital_guid' => 'required',
        ]);

        $doctor = Doctor::where('guid', $guid)->first();

        $doctor->update($data);
        $doctor = new SingleDoctorResource($doctor);
        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ]);
    }

    public function login(): JsonResponse
    {
        $data = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $doctor = Doctor::where('email', $data['email'])->first();

        if (!$doctor || !Hash::check($data['password'], $doctor->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }

        $token = $doctor->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $token,
                'user' => $doctor
            ]
        ]);
    }

    public function update($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'description' => 'required',
            'hospital_id' => 'required',
            'birth' => 'required',
        ]);

        $doctor = Doctor::where('guid', $guid)->first();

        $doctor->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $doctor
        ]);
    }

    public function destroy($guid): JsonResponse
    {
        $doctor = Doctor::where('guid', $guid)->first();

        $doctor->delete();

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor deleted'
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out'
        ]);
    }
}
