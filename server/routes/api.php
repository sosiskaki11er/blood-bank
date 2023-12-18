<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\BloodBankController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\DonorController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\InfusionController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\TransfusionController;
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

//BloodBanks
Route::get('bloodBank/showAll', [BloodBankController::class, 'index'])->middleware('auth:sanctum', 'role:admin');

Route::get('bloodBank/show/{guid}', [BloodBankController::class, 'show'])->middleware('auth:sanctum', 'role:doctor');

//Hospitals
Route::post('hospital/create', [HospitalController::class, 'create'])->middleware('auth:sanctum', 'role:admin');

Route::get('hospital/showAll', [HospitalController::class, 'index']);

Route::get('hospital/show/{guid}', [HospitalController::class, 'show'])->middleware('auth:sanctum', 'role:admin');

Route::post('hospital/update/{guid}', [HospitalController::class, 'update'])->middleware('auth:sanctum', 'role:admin');

Route::delete('hospital/delete/{guid}', [HospitalController::class, 'destroy'])->middleware('auth:sanctum', 'role:admin');

//Donors
Route::get('donor/showAll', [DonorController::class, 'index'])->middleware('auth:sanctum', 'role:donor');

Route::get('donor/show/{guid}', [DonorController::class, 'show'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/register', [DonorController::class, 'register']);

Route::post('donor/addBloodType/{guid}', [DonorController::class, 'addBloodType'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/login', [DonorController::class, 'login']);

Route::post('donor/logout', [DonorController::class, 'logout'])->middleware('auth:sanctum', 'role:donor');

Route::put('donor/update/{guid}', [DonorController::class, 'update'])->middleware('auth:sanctum', 'role:donor');

Route::get('donor/transfusion/index', [TransfusionController::class, 'donorIndex'])->middleware('auth:sanctum', 'role:donor');

Route::get('donor/transfusion/show/{guid}', [TransfusionController::class, 'show'])->middleware('auth:sanctum', 'role:donor');

Route::post('donor/transfusion/create', [TransfusionController::class, 'create'])->middleware('auth:sanctum', 'role:donor');

Route::delete('donor/delete/{guid}', [DonorController::class, 'destroy'])->middleware('auth:sanctum', 'role:donor');

//Patient
Route::get('patient/showAll', [PatientController::class, 'index'])->middleware('auth:sanctum', 'role:patient');

Route::get('patient/show/{guid}', [PatientController::class, 'show'])->middleware('auth:sanctum', 'role:patient');

Route::post('patient/register', [PatientController::class, 'register']);

Route::put('patient/addDoctor/{guid}', [PatientController::class, 'addDoctor'])->middleware('auth:sanctum', 'role:patient');

Route::post('patient/login', [PatientController::class, 'login']);

Route::post('patient/logout', [PatientController::class, 'logout'])->middleware('auth:sanctum', 'role:patient');

Route::put('patient/update/{guid}', [PatientController::class, 'update'])->middleware('auth:sanctum', 'role:patient');

Route::get('patient/infusion/index', [InfusionController::class, 'patientIndex'])->middleware('auth:sanctum', 'role:patient');

Route::get('patient/infusion/show/{guid}', [InfusionController::class, 'show'])->middleware('auth:sanctum', 'role:patient');

Route::post('patient/infusion/create', [InfusionController::class, 'create'])->middleware('auth:sanctum', 'role:patient');

Route::delete('patient/delete/{guid}', [PatientController::class, 'destroy'])->middleware('auth:sanctum', 'role:patient');

//Doctors
Route::get('doctor/showAll', [DoctorController::class, 'index'])->middleware('auth:sanctum', 'role:doctor');

Route::get('doctor/index', [DoctorController::class, 'showAll']);

Route::get('doctor/show/{guid}', [DoctorController::class, 'show'])->middleware('auth:sanctum', 'role:doctor');

Route::post('doctor/register', [DoctorController::class, 'register']);

Route::post('doctor/login', [DoctorController::class, 'login']);

Route::post('doctor/logout', [DoctorController::class, 'logout'])->middleware('auth:sanctum', 'role:doctor');

Route::put('doctor/update/{guid}', [DoctorController::class, 'update'])->middleware('auth:sanctum', 'role:doctor');

Route::get('doctor/infusion/index', [InfusionController::class, 'index'])->middleware('auth:sanctum', 'role:doctor');

Route::get('doctor/infusion/show/{guid}', [InfusionController::class, 'show'])->middleware('auth:sanctum', 'role:doctor');

Route::put('doctor/infusion/update/{guid}', [InfusionController::class, 'update'])->middleware('auth:sanctum', 'role:doctor');

Route::delete('doctor/delete/{guid}', [DoctorController::class, 'destroy'])->middleware('auth:sanctum', 'role:doctor');

//Staff
Route::get('staff/showAll', [StaffController::class, 'index'])->middleware('auth:sanctum', 'role:staff');

Route::get('staff/show/{guid}', [StaffController::class, 'show'])->middleware('auth:sanctum', 'role:staff');

Route::post('staff/register', [StaffController::class, 'register']);

Route::post('staff/login', [StaffController::class, 'login']);

Route::post('staff/logout', [StaffController::class, 'logout'])->middleware('auth:sanctum', 'role:staff');

Route::put('staff/update/{guid}', [StaffController::class, 'update'])->middleware('auth:sanctum', 'role:staff');

Route::delete('staff/delete/{guid}', [StaffController::class, 'destroy'])->middleware('auth:sanctum', 'role:staff');

Route::get('staff/transfusionsIndex', [TransfusionController::class, 'index'])->middleware('auth:sanctum', 'role:staff');

Route::get('staff/transfusionShow/{guid}', [TransfusionController::class, 'show'])->middleware('auth:sanctum', 'role:staff');

Route::put('staff/bloodTransfusion/{guid}', [TransfusionController::class, 'setStatus'])->middleware('auth:sanctum', 'role:staff');

//Admin
Route::post('admin/login', [AdminController::class, 'login']);

Route::post('admin/logout', [AdminController::class, 'logout'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/doctorsIndex', [DoctorController::class, 'index'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/doctorShow/{guid}', [DoctorController::class, 'show'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/doctorUpdate/{guid}', [DoctorController::class, 'update'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/doctorDelete/{guid}', [DoctorController::class, 'destroy'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/staffIndex', [StaffController::class, 'index'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/staffShow/{guid}', [StaffController::class, 'show'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/staffUpdate/{guid}', [StaffController::class, 'update'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/staffDelete/{guid}', [StaffController::class, 'destroy'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/patientsIndex', [PatientController::class, 'index'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/patientShow/{guid}', [PatientController::class, 'show'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/patientUpdate/{guid}', [PatientController::class, 'update'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/patientDelete/{guid}', [PatientController::class, 'destroy'])->middleware('auth:sanctum', 'role:admin');

Route::get('admin/donorsIndex', [DonorController::class, 'index'])->middleware('auth:sanctum', 'role:admin')->name('admin.donors.index');

Route::get('admin/donorShow/{guid}', [DonorController::class, 'show'])->middleware('auth:sanctum', 'role:admin');

Route::put('admin/donorUpdate/{guid}', [DonorController::class, 'adminUpdate'])->middleware('auth:sanctum', 'role:admin');

Route::delete('admin/donorDelete/{guid}', [DonorController::class, 'destroy'])->middleware('auth:sanctum', 'role:admin');
