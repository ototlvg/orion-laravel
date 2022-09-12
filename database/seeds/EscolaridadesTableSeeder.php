<?php

use Illuminate\Database\Seeder;

use App\Escolaridad;

class EscolaridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Primaria', 'Secundaria', 'Preparatoria o Bachillerato', 'Técnico Superior', 'Licenciatura', 'Maestría', 'Doctorado', 'Otro'];

        foreach ($data as $d) {
            $e = new Escolaridad();
            $e->escolaridad = $d;
            $e->save();
        }
    }
}
