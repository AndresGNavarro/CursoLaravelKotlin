<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //En esta función indicamos los seeder que se van a ejecutar
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(SpecialtiesTableSeeder::class);
    }
}
