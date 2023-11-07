<?php

namespace Database\Seeders;

use App\Models\HospitalHead;
use Illuminate\Database\Seeder;

class HospitalHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        HospitalHead::factory(5)->create();
    }
}
