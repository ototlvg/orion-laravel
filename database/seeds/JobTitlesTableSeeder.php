<?php

use Illuminate\Database\Seeder;

use App\Job;

class JobTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Estudiante', 'Medico', 'Ingeniero'];
        
        foreach ($data as $d) {
            $job = new Job();
            $job->name = $d;
            $job->save();
        }
    }
}
