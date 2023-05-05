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
        // \App\Models\User::factory(10)->create();

        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ProvidersSeeder::class,
            NetworksSeeder::class,
            StatusesSeeder::class,
            ComputersSeeder::class,
            TypesSeeder::class,
            PeripheralsSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
