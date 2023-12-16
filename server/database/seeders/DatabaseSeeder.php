<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BloodBank;
use App\Models\Doctor;
use App\Models\Donor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'doctor', 'guard_name' => 'doctor']);
        Role::create(['name' => 'donor', 'guard_name' => 'donor']);
        Role::create(['name' => 'patient', 'guard_name' => 'patient']);
        Role::create(['name' => 'staff', 'guard_name' => 'staff']);
        Role::create(['name' => 'admin', 'guard_name' => 'admin']);

        //create admin
        Admin::create([
            'name' => 'admin',
            'surname' => 'admin',
            'phone' => '123456789',
            'password' => Hash::make('password')
        ]);

        $hospital = Hospital::create([
            'name' => 'Hospital',
            'address' => 'Address',
        ]);

        $doctor = Doctor::create([
            'name' => 'Doctor',
            'surname' => 'Doctor',
            'phone' => '123456789',
            'password' => Hash::make('password'),
            'hospital_guid' => $hospital->guid
        ]);

        $staff = Staff::create([
            'name' => 'Staff',
            'surname' => 'Staff',
            'phone' => '123456789',
            'password' => Hash::make('password'),
            'hospital_guid' => $hospital->guid
        ]);

        $donor = Donor::create([
            'name' => 'Donor',
            'surname' => 'Donor',
            'phone' => '123456789',
            'password' => Hash::make('password'),
            'blood_type' => 'A',
            'blood_rh' => '+',
        ]);

        $patient = Patient::create([
            'name' => 'Patient',
            'surname' => 'Patient',
            'phone' => '123456789',
            'password' => Hash::make('password'),
            'doctor_guid' => $doctor->guid,
            'blood_type' => 'A',
            'blood_rh' => '+',
        ]);
    }
}
