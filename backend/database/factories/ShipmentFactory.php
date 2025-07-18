<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cargo;
use App\Models\Ship;
use App\Models\Port;

class ShipmentFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ['pending', 'in_transit', 'delivered', 'delayed'];
        $departure = $this->faker->dateTimeBetween('-1 month', 'now');
        $arrival_estimate = (clone $departure)->modify('+'.rand(2,20).' days');
        $actual_arrival = $this->faker->boolean(80) ? (clone $arrival_estimate)->modify('+'.rand(-2,5).' days') : null;
        return [
            'cargo_id' => Cargo::inRandomOrder()->first()?->id,
            'ship_id' => Ship::inRandomOrder()->first()?->id,
            'origin_port_id' => Port::inRandomOrder()->first()?->id,
            'destination_port_id' => Port::inRandomOrder()->first()?->id,
            'departure_date' => $departure->format('Y-m-d'),
            'arrival_estimate' => $arrival_estimate->format('Y-m-d'),
            'actual_arrival_date' => $actual_arrival ? $actual_arrival->format('Y-m-d') : null,
            'status' => $this->faker->randomElement($statuses),
            'is_active' => $this->faker->boolean(95),
        ];
    }
} 