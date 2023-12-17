<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use App\Models\Staff;
use App\Models\Transfusion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();

        return response()->json([
            'status' => 'success',
            'staff' => $staff
        ]);
    }

    public function show($guid)
    {
        $staff = Staff::where('guid', $guid)->first();

        return response()->json([
            'status' => 'success',
            'staff' => $staff
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:staff',
            'password' => 'required|string',
            'birth' => 'required',
        ]);
        $data['password'] = bcrypt($data['password']);


        $staff = Staff::create($data);

        return response()->json([
            'status' => 'success',
            'staff' => $staff
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|exists:staff',
            'password' => 'required|string',
        ]);

        $staff = Staff::where('phone', $data['phone'])->first();

        if (!$staff || !Hash::check($data['password'], $staff->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $staff->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Staff logged out'
        ]);
    }

    public function update(Request $request, $guid)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'surname' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string',
            'hospital_guid' => 'nullable|uuid',
            'birth' => 'nullable|date',
        ]);

        $staff = Staff::where('guid', $guid)->first();

        $staff->update($data);

        return response()->json([
            'status' => 'success',
            'staff' => $staff
        ]);
    }

    public function destroy($guid)
    {
        $staff = Staff::where('guid', $guid)->first();

        $staff->delete();

        return response()->json([
            'message' => 'Staff deleted'
        ]);
    }
}
