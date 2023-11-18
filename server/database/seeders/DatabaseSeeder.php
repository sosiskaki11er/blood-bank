<?php

namespace Database\Seeders;

use App\Models\BloodBank;
use App\Models\Hospital;
use App\Models\HospitalHead;
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
        HospitalHead::factory(2)->hasHospitals(2)->create();

//        Hospital::factory(10)->create();
    }
}
