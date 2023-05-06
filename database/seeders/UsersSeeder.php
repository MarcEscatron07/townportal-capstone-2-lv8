<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'fname' => 'Marc Benedict',
                'mname' => 'Cedillo',
                'lname' => 'Escatron',
                'username' => 'marcusbenz07',
                'email' => 'marc.escatron07@gmail.com',
                'image' => 'profile-owner.png',
                'password' => Hash::make('passowner'),
            ],
            [
                'role_id' => 2,
                'fname' => 'Ma. Espe',
                'mname' => 'Bines',
                'lname' => 'Gesalan',
                'username' => 'espegez28',
                'email' => 'espegez28@gmail.com',
                'image' => 'profile-manager.png',
                'password' => Hash::make('passmanager'),
            ],
            [
                'role_id' => 3,
                'fname' => 'Joshua',
                'mname' => 'Siga',
                'lname' => 'Alarva',
                'username' => 'kewnie25',
                'email' => 'kewnie@gmail.com',
                'image' => 'profile-staff.png',
                'password' => Hash::make('passstaff'),
            ],
        ]);
    }
}
