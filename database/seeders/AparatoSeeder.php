<?php

namespace Database\Seeders;

use App\Models\Aparato;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AparatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aparato = new Aparato();
        $aparato->nombre_a = 'Vault';
        $aparato->clave_a = 'VT';
        $aparato->save();

        $aparato = new Aparato();
        $aparato->nombre_a = 'Uneven Bars';
        $aparato->clave_a = 'UB';
        $aparato->save();

        $aparato = new Aparato();
        $aparato->nombre_a = 'Balance Beam';
        $aparato->clave_a = 'BB';
        $aparato->save();

        $aparato = new Aparato();
        $aparato->nombre_a = 'Floor Exercise';
        $aparato->clave_a = 'FX';
        $aparato->save();
    }
}
