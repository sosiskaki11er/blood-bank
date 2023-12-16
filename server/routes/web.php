<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\BloodBankController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\DonorController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\TransfusionController;
use App\Http\Controllers\InfusionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'test';
})->name('test');
