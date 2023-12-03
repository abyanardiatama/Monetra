<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Abyan',
            'email' => 'abyan@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Hasna',
            'email' => 'hasna@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Disa',
            'email' => 'disa@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Daffa',
            'email' => 'daffa@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Jun',
            'email' => 'jun@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
