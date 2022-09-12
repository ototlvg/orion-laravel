<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User();
        $u->name = "Admin Master";
        $u->email = 'admin@mmpi2.com';
        $u->password = Hash::make('adminpass123');
        $u->type = 2;
        $u->save();
    }
}
