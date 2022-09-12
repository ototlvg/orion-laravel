<?php

use Illuminate\Database\Seeder;

Use App\Nivel;

class NivelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Muy alto',76,	'76 o mas'],
            ['Alto',66,	'66 a 75'],
            ['Moderado',56,	'56 a 65'],
            ['Medio',41,	'41 a 55'],
            ['Bajo',40,	'40 o menos'],
            ['Muy alto',70,	'70 o mas'],
            ['Alto',60,	'60 a 69'],
            ['Moderado',51,	'51 a 59']
        ];

        foreach ($data as $d) {
            $n = new Nivel();
            $n->nivel = $d[0];
            $n->identificador = $d[1];
            $n->puntuacion = $d[2];
            $n->save();
        }
    }
}
