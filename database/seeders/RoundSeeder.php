<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ronda = new Round();
        $ronda->nombre_r = 'Qualifications';
        $ronda->clave_r = 'QF';
        $ronda->save();

        $ronda = new Round();
        $ronda->nombre_r = 'Team Finals';
        $ronda->clave_r = 'TF';
        $ronda->save();

        $ronda = new Round();
        $ronda->nombre_r = 'All Around';
        $ronda->clave_r = 'AA';
        $ronda->save();

        $ronda = new Round();
        $ronda->nombre_r = 'Event Finals';
        $ronda->clave_r = 'EF';
        $ronda->save();
    }
}
