<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HospitalHeadResource;
use App\Models\HospitalHead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class HospitalHeadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:hospital_heads|max:255',
            'password' => 'required',
            'address' => 'required'
        ]);
        $hospital_head = new HospitalHead();
        $hospital_head->guid = uuid_create(UUID_TYPE_RANDOM);
        $hospital_head->name = $request->name;
        $hospital_head->key_identifier = $request->key_identifier;
        $hospital_head->password = $request->password;
        $hospital_head->address = $request->address;
        $hospital_head->save();

        $token = $hospital_head->createToken('hospital_head_token')->plainTextToken;

        return response()->json(['hospital_head' => $hospital_head,'token' => $token], 201);
    }

    public function login(Request $request)
    {
        if (!auth()->attempt(['name' => $request->name, 'password' => $request->password])) {
            return response()->json('error, cannot to login', 401);
        }
        $token = auth()->user()->createToken('hospital_head_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('logout', 200);
    }

    public function update(Request $request)
    {
        $hospital_head = HospitalHead::where('guid', $request->user()->guid)->first();
        $hospital_head->name = $request->name;
        $hospital_head->key_identifier = $request->key_identifier;
        $hospital_head->password = $request->password;
        $hospital_head->address = $request->address;
        $hospital_head->save();

        return response()->json($hospital_head, 200);
    }

    public function delete(Request $request)
    {
        $hospital_head = HospitalHead::where('guid', $request->user()->guid)->first();
        $hospital_head->delete();

        $request->user()->currentAccessToken()->delete();

        return response()->json('deleted', 200);
    }

    public function show()
    {
        $hospital_heads = HospitalHead::get();
        return response()->json($hospital_heads, 200);
    }
}
