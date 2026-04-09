<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{

    public function run(): void
    {
        $filieres = [
            ['name' => 'Informatique', 'description' => 'Filière informatique : développement, réseaux et systèmes.'],
            ['name' => 'Électronique', 'description' => 'Filière électronique et automatisme.'],
            ['name' => 'Gestion', 'description' => 'Filière gestion et management.'],
            ['name' => 'Mécanique', 'description' => 'Filière mécanique et génie mécanique.'],
            ['name' => 'Réseaux & Télécommunications', 'description' => 'Filière réseaux informatiques et télécommunications.'],
            ['name' => 'Marketing Digital', 'description' => 'Filière marketing digital et commerce électronique.'],
            ['name' => 'Ressources Humaines', 'description' => 'Filière gestion des ressources humaines.'],
            ['name' => 'Finance & Comptabilité', 'description' => 'Filière finance, comptabilité et audit.'],
        ];

        foreach ($filieres as $filiere) {
            Filiere::updateOrCreate(['name' => $filiere['name']], $filiere);
        }
    }
}