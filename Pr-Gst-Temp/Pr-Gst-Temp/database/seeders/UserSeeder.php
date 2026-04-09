<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {

        $teachers = Teacher::all();
        $teacherUsers = [];
        foreach ($teachers as $teacher) {
            $teacherUsers[] = [
                'name' => $teacher->full_name,
                'email' => $teacher->email,
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'teacher_id' => $teacher->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($teacherUsers, 100) as $chunk) {
            foreach ($chunk as $user) {
                User::updateOrCreate(
                    ['email' => $user['email']],
                    $user
                );
            }
        }

        $groups = Group::all();
        $studentCount = 1;
        $studentUsers = [];

        foreach ($groups as $group) {

            $numStudents = rand(15, 20);
            for ($i = 1; $i <= $numStudents; $i++) {
                $studentUsers[] = [
                    'name' => "Étudiant {$studentCount}",
                    'email' => "etudiant{$studentCount}@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'group_id' => $group->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $studentCount++;
            }
        }

        foreach (array_chunk($studentUsers, 100) as $chunk) {
            foreach ($chunk as $user) {
                User::updateOrCreate(
                    ['email' => $user['email']],
                    $user
                );
            }
        }
    }
}