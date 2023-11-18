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

//Hospital Heads
Route::get('hospital-head/showAll', [\App\Http\Controllers\Api\HospitalHeadController::class, 'index'])->name('showAll')->middleware('auth:sanctum');

Route::get('hospital-head/show/{guid}', [\App\Http\Controllers\Api\HospitalHeadController::class, 'show'])->name('show')->middleware('auth:sanctum');

Route::post('hospital-head/register', [\App\Http\Controllers\Api\HospitalHeadController::class, 'register']);

Route::post('hospital-head/login', [\App\Http\Controllers\Api\HospitalHeadController::class, 'login'])->middleware('guest:sanctum');

Route::post('hospital-head/logout', [\App\Http\Controllers\Api\HospitalHeadController::class, 'logout'])->middleware('auth:sanctum');

Route::post('hospital-head/update', [\App\Http\Controllers\Api\HospitalHeadController::class, 'register'])->middleware('auth:sanctum');

Route::delete('hospital-head/delete', [\App\Http\Controllers\Api\HospitalHeadController::class, 'delete'])->middleware('auth:sanctum');

//Hospitals
Route::post('hospital/create', [\App\Http\Controllers\Api\HospitalController::class, 'store'])->middleware('auth:sanctum');

Route::get('hospital/showAll', [\App\Http\Controllers\Api\HospitalController::class, 'index'])->middleware('auth:sanctum');

Route::get('hospital/show/{guid}', [\App\Http\Controllers\Api\HospitalController::class, 'show'])->middleware('auth:sanctum');

Route::post('hospital/update/{guid}', [\App\Http\Controllers\Api\HospitalController::class, 'update'])->middleware('auth:sanctum');

Route::delete('hospital/delete/{guid}', [\App\Http\Controllers\Api\HospitalController::class, 'destroy'])->middleware('auth:sanctum');

// Blood-bank
Route::post('blood-bank/create', [\App\Http\Controllers\Api\BloodBankController::class, 'store'])->middleware('auth:sanctum');

Route::get('blood-bank/showAll', [\App\Http\Controllers\Api\BloodBankController::class, 'index'])->middleware('auth:sanctum');

Route::get('blood-bank/show/{guid}', [\App\Http\Controllers\Api\BloodBankController::class, 'show'])->middleware('auth:sanctum');

Route::post('blood-bank/update/{guid}', [\App\Http\Controllers\Api\BloodBankController::class, 'update'])->middleware('auth:sanctum');

Route::delete('blood-bank/delete/{guid}', [\App\Http\Controllers\Api\BloodBankController::class, 'destroy'])->middleware('auth:sanctum');


Route::get('hospital-head', function (Request $request){
    return $request->user();
})->middleware('auth:sanctum');


