<?php

use Illuminate\Database\Seeder;
use App\Result;

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
                $r= new Result;
                $r->patient_id= $i;
                $r->question= $j;
                $r->survey=1;
                $r->save();
            }


        }
    }
}
