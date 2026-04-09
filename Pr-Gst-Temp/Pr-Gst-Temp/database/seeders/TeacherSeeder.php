<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $teachers = [

            ['first_name' => 'Marie', 'last_name' => 'Dupont', 'email' => 'marie.dupont@example.com', 'phone' => '0601234501'],
            ['first_name' => 'Jean', 'last_name' => 'Martin', 'email' => 'jean.martin@example.com', 'phone' => '0601234502'],
            ['first_name' => 'Paul', 'last_name' => 'Bernard', 'email' => 'paul.bernard@example.com', 'phone' => '0601234503'],

            ['first_name' => 'Claude', 'last_name' => 'Lefevre', 'email' => 'claude.lefevre@example.com', 'phone' => '0601234504'],
            ['first_name' => 'Sophie', 'last_name' => 'Petit', 'email' => 'sophie.petit@example.com', 'phone' => '0601234505'],
            ['first_name' => 'Anne', 'last_name' => 'Richard', 'email' => 'anne.richard@example.com', 'phone' => '0601234506'],

            ['first_name' => 'Michel', 'last_name' => 'Thomas', 'email' => 'michel.thomas@example.com', 'phone' => '0601234507'],
            ['first_name' => 'Jacques', 'last_name' => 'Moreau', 'email' => 'jacques.moreau@example.com', 'phone' => '0601234508'],

            ['first_name' => 'Robert', 'last_name' => 'Durand', 'email' => 'robert.durand@example.com', 'phone' => '0601234509'],
            ['first_name' => 'Pierre', 'last_name' => 'Mercier', 'email' => 'pierre.mercier@example.com', 'phone' => '0601234510'],

            ['first_name' => 'Luc', 'last_name' => 'Blanc', 'email' => 'luc.blanc@example.com', 'phone' => '0601234511'],
            ['first_name' => 'Franck', 'last_name' => 'Vincent', 'email' => 'franck.vincent@example.com', 'phone' => '0601234512'],

            ['first_name' => 'Isabelle', 'last_name' => 'Laurent', 'email' => 'isabelle.laurent@example.com', 'phone' => '0601234513'],
            ['first_name' => 'Nathalie', 'last_name' => 'Fournier', 'email' => 'nathalie.fournier@example.com', 'phone' => '0601234514'],

            ['first_name' => 'Valérie', 'last_name' => 'Leclerc', 'email' => 'valerie.leclerc@example.com', 'phone' => '0601234515'],
            ['first_name' => 'Stéphane', 'last_name' => 'Arnould', 'email' => 'stephane.arnould@example.com', 'phone' => '0601234516'],

            ['first_name' => 'Olivier', 'last_name' => 'Guillot', 'email' => 'olivier.guillot@example.com', 'phone' => '0601234517'],
            ['first_name' => 'Dominique', 'last_name' => 'Guerin', 'email' => 'dominique.guerin@example.com', 'phone' => '0601234518'],

            ['first_name' => 'Catherine', 'last_name' => 'Adam', 'email' => 'catherine.adam@example.com', 'phone' => '0601234519'],
            ['first_name' => 'Sylvain', 'last_name' => 'Chevalier', 'email' => 'sylvain.chevalier@example.com', 'phone' => '0601234520'],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}