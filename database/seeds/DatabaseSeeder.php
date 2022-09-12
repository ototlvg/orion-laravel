<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeders obligatorios, se ejecutan despues de hacer php artisan migrate
        $this->call(MaritalTableSeeder::class);
        $this->call(EscolaridadesTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(JobTitlesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(EscalaTiposTableSeeder::class);
        $this->call(EscalasTableSeeder::class);
        $this->call(ConversionesTableSeeder::class);
        $this->call(NivelesTableSeeder::class);
        $this->call(InterpretacionesTableSeeder::class);
        $this->call(InterpretacionesValidezTableSeeder::class);

        // Seeder para crear Usuario Admin
        $this->call(UsersTableSeeder::class);

        // Seeders para crear 3 usuarios (se pueden crear mas, solo falta modificar un poco el codigo) 
        // de prueba con sus respectivas encuestas YA RESUELTAS.
        $this->call(PatientsTableSeeder::class);
        $this->call(ResultsTableSeeder::class);
    }
}
