<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PeripheralsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Peripheral::factory(30)->create();
    }
}
