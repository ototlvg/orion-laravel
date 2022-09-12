<?php

use Illuminate\Database\Seeder;

use App\Gender;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Masculino', 'Femenino'];

        foreach ($data as $d) {
            $g = new Gender();
            $g->gender = $d;
            $g->save();
        }
    }
}
