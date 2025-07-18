<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PortFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->city . ' Port',
            'country' => $this->faker->country(),
            'port_type' => $this->faker->randomElement(['Cargo', 'Passenger', 'Fishing', 'Military', 'Other']),
            'coordinates' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'depth' => $this->faker->randomFloat(2, 5, 50),
            'docking_capacity' => $this->faker->numberBetween(1, 20),
            'max_vessel_size' => $this->faker->randomFloat(2, 50, 400),
            'security_level' => $this->faker->randomElement(['High', 'Medium', 'Low']),
            'customs_authorized' => $this->faker->boolean(80),
            'operational_hours' => $this->faker->randomElement(['24/7', '06:00-22:00', '08:00-20:00']),
            'port_manager' => $this->faker->name(),
            'port_contact_info' => $this->faker->phoneNumber(),
            'is_active' => $this->faker->boolean(95),
        ];
    }
} 