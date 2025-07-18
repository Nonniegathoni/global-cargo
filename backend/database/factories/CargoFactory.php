<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

class CargoFactory extends Factory
{
    public function definition(): array
    {
        $types = ['perishable', 'dangerous', 'general', 'other'];
        return [
            'description' => $this->faker->sentence(8),
            'weight' => $this->faker->randomFloat(2, 100, 100000),
            'volume' => $this->faker->randomFloat(2, 1, 1000),
            'client_id' => Client::inRandomOrder()->first()?->id,
            'cargo_type' => $this->faker->randomElement($types),
            'is_active' => $this->faker->boolean(90),
        ];
    }
} 