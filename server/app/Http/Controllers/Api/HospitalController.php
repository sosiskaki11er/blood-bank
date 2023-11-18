<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'head_id' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);

        $hospital = new Hospital();
        $hospital->guid = uuid_create(UUID_TYPE_RANDOM);
        $hospital->name = $request->name;
        $hospital->head_id = $request->head_id;
        $hospital->address = $request->address;
        $hospital->password = Hash::make($request->password);
        $hospital->save();

        return response()->json([
            'status' => 'success',
            'data' => $hospital
        ], 201);
    }

    public function show(Request $request): JsonResponse
    {
        $hospital = Hospital::where('guid', $request->guid)->first();
        return response()->json([
            'status' => 'success',
            'data' => $hospital
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $hospital = Hospital::where('guid', $request->guid)->first();
        if ($request->name)
            $hospital->name = $request->name;
        if ($request->head_id)
            $hospital->head_id = $request->head_id;
        if ($request->address)
            $hospital->address = $request->address;
        if ($request->password)
            $hospital->password = $request->password;
        $hospital->save();

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
