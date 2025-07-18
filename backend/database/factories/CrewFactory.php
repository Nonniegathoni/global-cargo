<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ship;

class CrewFactory extends Factory
{
    public function definition(): array
    {
        $roles = ['Captain', 'Chief Officer', 'Able Seaman', 'Ordinary Seaman', 'Engine Cadet', 'Radio Officer', 'Chief Cook', 'Steward', 'Deckhand'];
        return [
            'ship_id' => Ship::inRandomOrder()->first()?->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'role' => $this->faker->randomElement($roles),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'nationality' => $this->faker->country(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
} 