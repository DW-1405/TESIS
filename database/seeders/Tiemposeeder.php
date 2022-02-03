<?php

namespace Database\Seeders;
use App\Models\Tiempo;

use Illuminate\Database\Seeder;

class Tiemposeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tiempo::create([
            'tiempo_inicio' => '0.000',
            'tiempo_final' => '0.000'
        ]);
    }
}
