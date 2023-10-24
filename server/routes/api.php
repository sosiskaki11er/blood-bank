<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::get('hospital-head/show', [\App\Http\Controllers\Api\HospitalHeadController::class, 'show'])->name('show');

    Route::get('hospital-head/update', [\App\Http\Controllers\Api\HospitalHeadController::class, 'store']);


Route::post('hospital-head/add', [\App\Http\Controllers\Api\HospitalHeadController::class, 'store']);

Route::post('hospital-head/login', [\App\Http\Controllers\Api\HospitalHeadController::class, 'password_check']);


