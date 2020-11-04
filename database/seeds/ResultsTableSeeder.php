<?php

use Illuminate\Database\Seeder;
use App\Result;
use Faker\Factory as Factory;

class ResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desde= 1;
        $hasta= 3;

        for ($i=$desde; $i<=$hasta; $i++){

            for ($j=1; $j<=567; $j++){
                $faker = Factory::create();
                $r= new Result;
                $r->patient_id= $i;
                $r->question= $j;
                $r->survey=1;
                $r->answer= $faker->randomElement([0,1]);
//                $r->answer= 1;
                $r->save();
            }


        }
    }
}
