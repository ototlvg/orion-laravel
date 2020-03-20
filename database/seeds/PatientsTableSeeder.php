<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Factory;
use App\Patient;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<3; $i++){
            $faker = Factory::create();
            $p= new Patient;
//            $p->code=$faker->ean13;
            $p->code=$faker->sha1;
            $p->name=$faker->firstName('male'|'female');
            $p->apaterno=$faker->lastName;
            $p->amaterno=$faker->lastName;
            $p->gender=$faker->randomElement($array = array (1,2));
            $p->marital_status=$faker->randomElement($array = array (1,2,3,4,5,6));;
            $p->birthday=$faker->date($format = 'Y-m-d', $max = 'now');
            $p->job=$faker->randomElement($array = array (1,2,3));
            $p->save();
        }
    }
}
