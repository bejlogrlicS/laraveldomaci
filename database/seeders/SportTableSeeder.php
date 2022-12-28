<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sport::create([
            'sport' => 'Fudbal'
        ]);

        Sport::create([
            'sport' => 'Hokej'
        ]);

        Sport::create([
            'sport' => 'Vaterpolo'
        ]);

    }
}
