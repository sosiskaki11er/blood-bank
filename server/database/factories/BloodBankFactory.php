<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=BloodBank>
 */
class BloodBankFactory extends Factory
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
            'hospital_guid' => Hospital::factory(),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'amount' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
