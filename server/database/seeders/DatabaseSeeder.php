<?php

namespace Database\Seeders;

use App\Models\BloodBank;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'donor']);
        Role::create(['name' => 'patient']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'admin']);

        Hospital::factory(1)->create();
        Doctor::factory(2)->create();
    }
}
