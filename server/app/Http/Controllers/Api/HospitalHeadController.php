<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HospitalHead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class HospitalHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $hospital_head = new HospitalHead();
        $hospital_head->guid = uuid_create();
        $hospital_head->key_identifier = $request->key_identifier;
        $hospital_head->name = $request->name;
        $hospital_head->password = Hash::make($request->password);
        $hospital_head->address = $request->address;
        $hospital_head->save();

        return 'hospital head saved successfully';
    }

    public function password_check(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $hospital_head = HospitalHead::where('name', $request->name)->first();
        $message = '';
        if (Hash::check($request->password, $hospital_head->password)) {
            $message = 'Authorization success';
            return response($hospital_head, 201);
        } else {
            $message = 'Authorization failed';
            return redirect()->route('login');
        }
//        return response()->json('error', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show()
    {
        return response()->json('redirected to the show route', 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
