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
    	User::create([
 		'name' => 'Andrés Navarro',
        'email' => 'andresgnavarro94@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123'),  
        'remember_token' => Str::random(10),
        'cedula' => '1123717328',
        'role' => 'admin'   			
    	 ]);

        User::create([
        'name' => 'Heriberto Tortellini',
        'email' => 'tortellini@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123'),  
        'remember_token' => Str::random(10),
        'cedula' => '1123717328',
        'role' => 'patient'               
         ]);

        User::create([
        'name' => 'Leisa Elena',
        'email' => 'leisa@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123'),  
        'remember_token' => Str::random(10),
        'cedula' => '1123717328',
        'role' => 'doctor'               
         ]);
        factory(User::class, 50)->create();
    
    }
}
