<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $nurses = Nurse::all();
        return response()->json([
            'status' => 'success',
            'data' => $nurses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
            return response()->json([
                'status' => 'success',
                'data' => 'nurse created'
            ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

                $request->validate([
                    'name' => 'required',
                    'hospital_id' => 'required',
                    'address' => 'required',
                    'password' => 'required',
                ]);

                $nurse = new Nurse();
                $nurse->guid = uuid_create(UUID_TYPE_RANDOM);
                $nurse->name = $request->name;
                $nurse->hospital_id = $request->hospital_id;
                $nurse->address = $request->address;
                $nurse->password = Hash::make($request->password);
                $nurse->save();

                return response()->json([
                    'status' => 'success',
                    'data' => $nurse
                ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
