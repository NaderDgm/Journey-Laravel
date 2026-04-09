<?php

namespace Database\Seeders;

use App\Models\Filiere;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $groups = [

            ['code' => 'INF-L1-A', 'filiere_name' => 'Informatique', 'year' => 1],
            ['code' => 'INF-L1-B', 'filiere_name' => 'Informatique', 'year' => 1],
            ['code' => 'INF-L1-C', 'filiere_name' => 'Informatique', 'year' => 1],

            ['code' => 'INF-L2-A', 'filiere_name' => 'Informatique', 'year' => 2],
            ['code' => 'INF-L2-B', 'filiere_name' => 'Informatique', 'year' => 2],

            ['code' => 'INF-L3-A', 'filiere_name' => 'Informatique', 'year' => 3],

            ['code' => 'ELE-L1-A', 'filiere_name' => 'Électronique', 'year' => 1],
            ['code' => 'ELE-L1-B', 'filiere_name' => 'Électronique', 'year' => 1],

            ['code' => 'ELE-L2-A', 'filiere_name' => 'Électronique', 'year' => 2],

            ['code' => 'GES-L1-A', 'filiere_name' => 'Gestion', 'year' => 1],
            ['code' => 'GES-L1-B', 'filiere_name' => 'Gestion', 'year' => 1],
            ['code' => 'GES-L1-C', 'filiere_name' => 'Gestion', 'year' => 1],

            ['code' => 'GES-L2-A', 'filiere_name' => 'Gestion', 'year' => 2],
            ['code' => 'GES-L2-B', 'filiere_name' => 'Gestion', 'year' => 2],

            ['code' => 'MEC-L1-A', 'filiere_name' => 'Mécanique', 'year' => 1],
            ['code' => 'MEC-L1-B', 'filiere_name' => 'Mécanique', 'year' => 1],

            ['code' => 'MEC-L2-A', 'filiere_name' => 'Mécanique', 'year' => 2],

            ['code' => 'RES-L1-A', 'filiere_name' => 'Réseaux & Télécommunications', 'year' => 1],
            ['code' => 'RES-L1-B', 'filiere_name' => 'Réseaux & Télécommunications', 'year' => 1],

            ['code' => 'RES-L2-A', 'filiere_name' => 'Réseaux & Télécommunications', 'year' => 2],

            ['code' => 'MKT-L1-A', 'filiere_name' => 'Marketing Digital', 'year' => 1],
            ['code' => 'MKT-L1-B', 'filiere_name' => 'Marketing Digital', 'year' => 1],

            ['code' => 'RH-L1-A', 'filiere_name' => 'Ressources Humaines', 'year' => 1],
            ['code' => 'RH-L1-B', 'filiere_name' => 'Ressources Humaines', 'year' => 1],

            ['code' => 'FC-L1-A', 'filiere_name' => 'Finance & Comptabilité', 'year' => 1],
            ['code' => 'FC-L1-B', 'filiere_name' => 'Finance & Comptabilité', 'year' => 1],
        ];

        foreach ($groups as $groupData) {
            $filiere = Filiere::where('name', $groupData['filiere_name'])->first();
            if (!$filiere) {
                continue;
            }

            Group::create([
                'code' => $groupData['code'],
                'filiere_id' => $filiere->id,
                'year' => $groupData['year'],
            ]);
        }
    }
}