<?php

namespace Database\Seeders;

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

         \App\Models\User::create([
             'name' => 'Frontend',
             'email' => 'user@gmail.com',
             'password' => bcrypt('digitaltolk'),
             'email_verified_at' => now(),
         ]);
    }
}
