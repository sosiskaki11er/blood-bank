<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);
        $data['guid'] = Str::uuid();
        $hospital = Hospital::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $hospital
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
