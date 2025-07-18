<?php

namespace Database\Seeders;

use App\Models\Crew;
use Illuminate\Database\Seeder;

class CrewSeeder extends Seeder
{
    public function run(): void
    {
        Crew::factory(15)->create();
    }
} 