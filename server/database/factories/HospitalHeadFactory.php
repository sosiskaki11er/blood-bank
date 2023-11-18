<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HospitalHead>
 */
class HospitalHeadFactory extends Factory
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
            'name' => $this->faker->name,
            'key_identifier' => $this->faker->uuid,
            'password' => '$2y$10$/qgA0A3YPUMZKe6XzF2ViOrRKWi5RP/G.w4DmwBfTs.l4OqYbE1gW',
            'address' => $this->faker->address,
        ];
    }
}