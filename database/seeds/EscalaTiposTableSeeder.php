<?php

use Illuminate\Database\Seeder;

use App\EscalaTipo;

class EscalaTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Basica', 'Suplementaria', 'Contenido'];

        foreach ($data as $d) {
            $e = new EscalaTipo();
            $e->tipo = $d;
            $e->save();
        }
    }
}
