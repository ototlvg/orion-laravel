<?php

use Illuminate\Database\Seeder;

use App\Marital;

class MaritalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Soltero', 'Casado', 'Union libre', 'Divorciado', 'Separado', 'Viudo'];

        foreach ($data as $d) {
            $marital = new Marital();
            $marital->status = $d;
            $marital->save();
        }
    }
}
