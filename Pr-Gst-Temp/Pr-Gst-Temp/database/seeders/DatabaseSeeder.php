<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin2@example.com',
            'role' => 'admin',
        ]);

        $this->call([
            FiliereSeeder::class,
            RoomSeeder::class,
            TeacherSeeder::class,
            GroupSeeder::class,
            ScheduleSeeder::class,
            UserSeeder::class,
        ]);
    }
}