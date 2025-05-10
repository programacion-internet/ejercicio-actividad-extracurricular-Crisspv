<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evento::factory()->count(10)->create([
            'fecha' => now()->addDays(rand(-10, 10)), // mezcla de eventos pasados y futuros
        ]);   
    }
}
