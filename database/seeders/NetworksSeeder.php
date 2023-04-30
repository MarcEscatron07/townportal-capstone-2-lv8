<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Network::factory(5)->create();
    }
}
