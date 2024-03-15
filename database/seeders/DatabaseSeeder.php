<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Kelas::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'photo' => 'test.jpg',
            'id_assisten' => 'gjk123',
            'password' => bcrypt('test123'),
        ]);

        \App\Models\User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'role' => 'admin',
            'photo' => 'test2.jpg',
            'id_assisten' => 'gjk123',
            'password' => bcrypt('test123'),
        ]);

        \App\Models\Kelas::factory(5)->create();

        \App\Models\Materi::factory(7)->create();
    }
}
