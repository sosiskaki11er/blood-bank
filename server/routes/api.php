<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\HospitalHeadController;
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

//Hospitals
Route::post('hospital/create', [\App\Http\Controllers\Api\HospitalController::class, 'store']);

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

//Donors
Route::get('donor/showAll', [\App\Http\Controllers\Api\DonorController::class, 'index'])->middleware('auth:sanctum');

Route::get('donor/show/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'show'])->middleware('auth:sanctum');

Route::post('donor/register', [\App\Http\Controllers\Api\DonorController::class, 'register']);

Route::post('donor/addBloodType/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'addBloodType'])->middleware('auth:sanctum');

Route::post('donor/doctorsRecommendation/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'doctorRecommendation'])->middleware('auth:sanctum');

Route::post('donor/login', [\App\Http\Controllers\Api\DonorController::class, 'login']);

Route::post('donor/logout', [\App\Http\Controllers\Api\DonorController::class, 'logout'])->middleware('auth:sanctum');

Route::put('donor/update/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'update'])->middleware('auth:sanctum');

Route::delete('donor/delete/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'destroy'])->middleware('auth:sanctum');

//Doctors
Route::get('doctor/showAll', [DoctorController::class, 'index'])->middleware('auth:sanctum');

Route::get('doctor/show/{guid}', [DoctorController::class, 'show'])->middleware('auth:sanctum');

Route::post('doctor/register', [DoctorController::class, 'register']);

Route::put('doctor/addHospital/{guid}', [DoctorController::class, 'addHospital'])->middleware('auth:sanctum');

Route::post('doctor/login', [DoctorController::class, 'login']);

Route::post('doctor/logout', [DoctorController::class, 'logout'])->middleware('auth:sanctum');

Route::put('doctor/update/{guid}', [DoctorController::class, 'update'])->middleware('auth:sanctum');

Route::delete('doctor/delete/{guid}', [DoctorController::class, 'destroy'])->middleware('auth:sanctum');
