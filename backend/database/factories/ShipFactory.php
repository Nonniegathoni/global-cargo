<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShipFactory extends Factory
{
    public function definition(): array
    {
        $types = ['cargo ship', 'passenger ship', 'military ship', 'icebreaker', 'fishing vessel', 'barge ship'];
        $statuses = ['active', 'under maintenance', 'decommissioned'];
        return [
            'name' => $this->faker->company . ' Vessel',
            'registration_number' => $this->faker->unique()->bothify('SHIP-####-????'),
            'capacity_in_tonnes' => $this->faker->randomFloat(2, 500, 200000),
            'type' => $this->faker->randomElement($types),
            'status' => $this->faker->randomElement($statuses),
            'is_active' => $this->faker->boolean(90),
        ];
    }
} 