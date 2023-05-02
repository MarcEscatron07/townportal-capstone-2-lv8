<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComputersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Computer::factory(30)->create();
    }
}
