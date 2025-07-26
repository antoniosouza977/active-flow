<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $testUser = [
            'name' => 'Antonio Souza',
            'email' => 'antonio@gmail.com',
            'password' => bcrypt('senha123'),
        ];

        User::query()->updateOrCreate(['email' => $testUser['email']], $testUser);

        if (User::query()->count() < 20) {
            User::factory(200)->create();
        }
    }
}
