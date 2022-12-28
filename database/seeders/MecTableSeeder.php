<?php

namespace Database\Seeders;

use App\Models\Mec;
use Illuminate\Database\Seeder;

class MecTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {

            Mec::create([
                'prviTimID' => rand(1,10),
                'drugiTimID' => rand(11,20),
                'rezultat' => $faker->numerify(' # - #'),
                'sportID' => rand(1,3)
            ]);
        }
    }
}
