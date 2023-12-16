<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Donor;
use App\Models\Patient;
use App\Models\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\Comment\Doc;

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
        $doctors = Doctor::all();

        return response()->json([
            'status' => 'success',
            'data' => $doctors
        ]);
    }

    public function doctorShow($guid): JsonResponse
    {
        $doctor = Doctor::where('guid', $guid)->first();

        if ($doctor)
        {
            return response()->json([
                'status' => 'success',
                'data' => $doctor
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found'
            ], 404);
        }

    }

public function doctorUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $doctor = Doctor::where('guid', $guid)->first();

        if ($doctor)
        {
            $doctor->update($data);

            return response()->json([
                'status' => 'success',
                'data' => $doctor
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found'
            ], 404);
        }
    }

    public function doctorDelete($guid): JsonResponse
    {
        $doctor = Doctor::where('guid', $guid)->first();

        if ($doctor)
        {
            $doctor->delete();

            return response()->json([
                'status' => 'success',
                'data' => $doctor
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Doctor not found'
            ], 404);
        }
    }

    public function staffIndex(): JsonResponse
    {
        $staff = Staff::all();

        if ($staff)
        {
            return response()->json([
                'status' => 'success',
                'data' => $staff
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Staff not found'
            ], 404);
        }
    }

    public function staffShow($guid): JsonResponse
    {
        $staff = Staff::where('guid', $guid)->first();

        if ($staff)
        {
            return response()->json([
                'status' => 'success',
                'data' => $staff
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Staff not found'
            ], 404);
        }
    }

    public function staffUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $staff = Staff::where('guid', $guid)->first();

        if ($staff)
        {
            $staff->update($data);

            return response()->json([
                'status' => 'success',
                'data' => $staff
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Staff not found'
            ], 404);
        }
    }

    public function staffDelete($guid): JsonResponse
    {
        $staff = Staff::where('guid', $guid)->first();

        if ($staff)
        {
            $staff->delete();

            return response()->json([
                'status' => 'success',
                'data' => $staff
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Staff not found'
            ], 404);
        }
    }

    public function patientsIndex(): JsonResponse
    {
        $patients = Patient::all();

        if ($patients)
        {
            return response()->json([
                'status' => 'success',
                'data' => $patients
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Patients not found'
            ], 404);
        }
    }

    public function patientShow($guid): JsonResponse
    {
        $patient = Patient::where('guid', $guid)->first();

        if ($patient)
        {
            return response()->json([
                'status' => 'success',
                'data' => $patient
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
    }

    public function patientUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $patient = Patient::where('guid', $guid)->first();

        if ($patient)
        {
            $patient->update($data);

            return response()->json([
                'status' => 'success',
                'data' => $patient
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
    }

    public function patientDelete($guid): JsonResponse
    {
        $patient = Patient::where('guid', $guid)->first();

        if ($patient)
        {
            $patient->delete();

            return response()->json([
                'status' => 'success',
                'data' => $patient
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found'
            ], 404);
        }
    }

    public function donorsIndex(): JsonResponse
    {
        $donors = Donor::all();

        if ($donors)
        {
            return response()->json([
                'status' => 'success',
                'data' => $donors
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Donors not found'
            ], 404);
        }
    }

    public function donorShow($guid): JsonResponse
    {
        $donor = Donor::where('guid', $guid)->first();

        if ($donor)
        {
            return response()->json([
                'status' => 'success',
                'data' => $donor
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Donor not found'
            ], 404);
        }
    }

    public function donorUpdate($guid): JsonResponse
    {
        $data = request()->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'password' => 'nullable',
        ]);

        $donor = Donor::where('guid', $guid)->first();

        if ($donor)
        {
            $donor->update($data);

            return response()->json([
                'status' => 'success',
                'data' => $donor
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Donor not found'
            ], 404);
        }
    }

    public function donorDelete($guid): JsonResponse
    {
        $donor = Admin::where('guid', $guid)->first();

        if ($donor)
        {
            $donor->delete();

            return response()->json([
                'status' => 'success',
                'data' => $donor
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Donor not found'
            ], 404);
        }
    }
}
