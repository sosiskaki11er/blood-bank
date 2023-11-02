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


Route::get('hospital-head/show', [\App\Http\Controllers\Api\HospitalHeadController::class, 'show'])->name('show')->middleware('auth:sanctum');

Route::post('hospital-head/register', [\App\Http\Controllers\Api\HospitalHeadController::class, 'register']);

Route::post('hospital-head/login', [\App\Http\Controllers\Api\HospitalHeadController::class, 'login'])->middleware('guest:sanctum');

Route::post('hospital-head/update', [\App\Http\Controllers\Api\HospitalHeadController::class, 'register'])->middleware('auth:sanctum');

Route::post('hospital-head/logout', [\App\Http\Controllers\Api\HospitalHeadController::class, 'logout'])->middleware('auth:sanctum');

Route::delete('hospital-head/delete', [\App\Http\Controllers\Api\HospitalHeadController::class, 'delete'])->middleware('auth:sanctum');

Route::delete('hospital-head/show', [\App\Http\Controllers\Api\HospitalHeadController::class, 'show']);

Route::get('hospital-head', function (Request $request){
    return $request->user();
})->middleware('auth:sanctum');


