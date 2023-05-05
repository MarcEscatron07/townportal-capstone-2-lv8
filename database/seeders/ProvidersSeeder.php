<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
        	['name' => 'PLDT'],
        	['name' => 'Globe'],
        	['name' => 'Converge'],
        	['name' => 'DITO'],
        	['name' => 'Starlink'],
        ]);
    }
}
