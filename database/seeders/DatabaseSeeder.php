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
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ProvidersSeeder::class,
            NetworksSeeder::class, // comment when not needed in seeding
            StatusesSeeder::class,
            ComputersSeeder::class, // comment when not needed in seeding
            TypesSeeder::class,
            PeripheralsSeeder::class, // comment when not needed in seeding
            CategoriesSeeder::class,
            ProductsSeeder::class, // comment when not needed in seeding
        ]);
    }
}
