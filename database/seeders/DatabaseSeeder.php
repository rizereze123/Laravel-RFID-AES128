<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(env('seedPWD')),
            'role' => 'Admin',
            'status' => 1
        ]);

        User::create([
            'name' => 'Hanekawa',
            'email' => 'staff@gmail.com',
            'password' => bcrypt(env('seedPWD')),
            'role' => 'Staff',
            'status' => 1
        ]);
    }
}
