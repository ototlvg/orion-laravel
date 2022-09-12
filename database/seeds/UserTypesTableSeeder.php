<?php

use Illuminate\Database\Seeder;

use App\UserType;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['patient', 'admin'];

        foreach ($data as $d) {
            $ut = new UserType();
            $ut->name = $d;
            $ut->save();
        }
    }
}
