<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
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
Route::get('donor/showAll', [\App\Http\Controllers\Api\DonorController::class, 'index'])->middleware('auth:sanctum', 'role:donor');

Route::get('donor/show/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'show'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/register', [\App\Http\Controllers\Api\DonorController::class, 'register']);

Route::post('donor/addBloodType/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'addBloodType'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/doctorsRecommendation/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'doctorRecommendation'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/login', [\App\Http\Controllers\Api\DonorController::class, 'login']);

Route::post('donor/logout', [\App\Http\Controllers\Api\DonorController::class, 'logout'])->middleware('auth:sanctum', 'role:donor');

Route::put('donor/update/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'update'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/transfusion/create', [\App\Http\Controllers\Api\TransfusionController::class, 'create'])->middleware('auth:sanctum', 'role:donor');

Route::delete('donor/delete/{guid}', [\App\Http\Controllers\Api\DonorController::class, 'destroy'])->middleware('auth:sanctum', 'role:donor');

//Patient
Route::get('patient/showAll', [PatientController::class, 'index'])->middleware('auth:sanctum', 'role:patient');

Route::get('patient/show/{guid}', [PatientController::class, 'show'])->middleware('auth:sanctum', 'role:patient');

Route::post('patient/register', [PatientController::class, 'register']);

Route::put('patient/addDoctor/{guid}', [PatientController::class, 'addDoctor'])->middleware('auth:sanctum', 'role:patient');

Route::post('patient/login', [PatientController::class, 'login']);

Route::post('patient/logout', [PatientController::class, 'logout'])->middleware('auth:sanctum', 'role:patient');

Route::put('patient/update/{guid}', [PatientController::class, 'update'])->middleware('auth:sanctum', 'role:patient');

Route::delete('patient/delete/{guid}', [PatientController::class, 'destroy'])->middleware('auth:sanctum', 'role:patient');

//Doctors
Route::get('doctor/showAll', [DoctorController::class, 'index'])->middleware('auth:sanctum', 'role:doctor');

Route::get('doctor/show/{guid}', [DoctorController::class, 'show'])->middleware('auth:sanctum', 'role:doctor');

Route::post('doctor/register', [DoctorController::class, 'register']);

Route::put('doctor/addHospital/{guid}', [DoctorController::class, 'addHospital'])->middleware('auth:sanctum', 'role:doctor');

Route::post('doctor/login', [DoctorController::class, 'login']);

Route::post('doctor/logout', [DoctorController::class, 'logout'])->middleware('auth:sanctum', 'role:doctor');

Route::put('doctor/update/{guid}', [DoctorController::class, 'update'])->middleware('auth:sanctum', 'role:doctor');

Route::delete('doctor/delete/{guid}', [DoctorController::class, 'destroy'])->middleware('auth:sanctum', 'role:doctor');

//Staff
Route::get('staff/showAll', [\App\Http\Controllers\Api\StaffController::class, 'index'])->middleware('auth:sanctum', 'role:staff');

Route::get('staff/show/{guid}', [\App\Http\Controllers\Api\StaffController::class, 'show'])->middleware('auth:sanctum', 'role:staff');

Route::post('staff/register', [\App\Http\Controllers\Api\StaffController::class, 'register']);

Route::post('staff/login', [\App\Http\Controllers\Api\StaffController::class, 'login']);

Route::post('staff/logout', [\App\Http\Controllers\Api\StaffController::class, 'logout'])->middleware('auth:sanctum', 'role:staff');

Route::put('staff/update/{guid}', [\App\Http\Controllers\Api\StaffController::class, 'update'])->middleware('auth:sanctum', 'role:staff');

Route::delete('staff/delete/{guid}', [\App\Http\Controllers\Api\StaffController::class, 'destroy'])->middleware('auth:sanctum', 'role:staff');

Route::get('staff/transfusionShow', [\App\Http\Controllers\Api\TransfusionController::class, 'transfusionShow'])->middleware('auth:sanctum', 'role:staff');

Route::put('staff/bloodTransfusion/{guid}', [\App\Http\Controllers\Api\TransfusionController::class, 'setStatus'])->middleware('auth:sanctum', 'role:staff');

//Admin
Route::post('admin/login', [\App\Http\Controllers\Api\AdminController::class, 'login']);

Route::post('admin/logout', [\App\Http\Controllers\Api\AdminController::class, 'logout'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/doctorsIndex', [\App\Http\Controllers\Api\AdminController::class, 'doctorsIndex'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/doctorShow/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'doctorShow'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/doctorUpdate/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'doctorUpdate'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/doctorDelete/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'doctorDelete'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/patientsIndex', [\App\Http\Controllers\Api\AdminController::class, 'patientsIndex'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/patientShow/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'patientShow'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/patientUpdate/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'patientUpdate'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/patientDelete/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'patientDelete'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/donorsIndex', [\App\Http\Controllers\Api\AdminController::class, 'donorsIndex'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/donorShow/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'donorShow'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/donorUpdate/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'donorUpdate'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/donorDelete/{guid}', [\App\Http\Controllers\Api\AdminController::class, 'donorDelete'])->middleware('auth:sanctum', 'role:admin');
