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
       $this->call(UserTableSeeder::class);
       $this->call(TimTableSeeder::class);
       $this->call(SportTableSeeder::class);
       $this->call(MecTableSeeder::class);
    }
}
