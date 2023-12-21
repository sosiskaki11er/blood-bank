<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'guid' => $this->faker->uuid,
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'password' => '$2y$10$/L536tnUlvFOfKLLt6LhhODyQlXcbbjyVLGqqUQNQkSpkRBd7FDcO',
            'hospital_guid' => '0c259de9-7706-4cca-b9e7-4cecdaaa0025',
            'birth' => $this->faker->date(),
        ];
    }
}
