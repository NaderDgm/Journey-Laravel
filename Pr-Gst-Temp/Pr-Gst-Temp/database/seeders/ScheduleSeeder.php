<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
        $slots = [
            '08:30' => '11:00',
            '11:00' => '13:30',
            '13:30' => '16:00',
            '16:00' => '18:30',
        ];

        $groups = Group::all();
        $teachers = Teacher::all();
        $rooms = Room::all();

        if ($groups->isEmpty() || $teachers->isEmpty() || $rooms->isEmpty()) {
            return;
        }

        $schedules = [

            ['group_code' => 'INF-L1-A', 'title' => 'Programmation PHP', 'day' => 'Lundi', 'slot' => '08:30', 'room' => 'A1', 'teacher_name' => 'Marie Dupont'],
            ['group_code' => 'INF-L1-A', 'title' => 'Bases de données', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'A2', 'teacher_name' => 'Jean Martin'],
            ['group_code' => 'INF-L1-A', 'title' => 'Réseaux', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'C3', 'teacher_name' => 'Paul Bernard'],
            ['group_code' => 'INF-L1-A', 'title' => 'Architecture ordinateurs', 'day' => 'Lundi', 'slot' => '16:00', 'room' => 'A3', 'teacher_name' => 'Luc Blanc'],
            ['group_code' => 'INF-L1-A', 'title' => 'Anglais technique', 'day' => 'Mardi', 'slot' => '08:30', 'room' => 'A1', 'teacher_name' => 'Valérie Leclerc'],
            ['group_code' => 'INF-L1-A', 'title' => 'Système Linux', 'day' => 'Mardi', 'slot' => '11:00', 'room' => 'B3', 'teacher_name' => 'Franck Vincent'],
            ['group_code' => 'INF-L1-A', 'title' => 'Développement Web', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'A2', 'teacher_name' => 'Marie Dupont'],
            ['group_code' => 'INF-L1-A', 'title' => 'Logique numérique', 'day' => 'Jeudi', 'slot' => '13:30', 'room' => 'A4', 'teacher_name' => 'Olivier Guillot'],
            ['group_code' => 'INF-L1-A', 'title' => 'Projet programmation', 'day' => 'Vendredi', 'slot' => '08:30', 'room' => 'B1', 'teacher_name' => 'Jean Martin'],

            ['group_code' => 'INF-L1-B', 'title' => 'Programmation Python', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'B1', 'teacher_name' => 'Sophie Petit'],
            ['group_code' => 'INF-L1-B', 'title' => 'Algorithmique', 'day' => 'Lundi', 'slot' => '16:00', 'room' => 'B2', 'teacher_name' => 'Marie Dupont'],
            ['group_code' => 'INF-L1-B', 'title' => 'Bases de données', 'day' => 'Mardi', 'slot' => '13:30', 'room' => 'A2', 'teacher_name' => 'Jean Martin'],
            ['group_code' => 'INF-L1-B', 'title' => 'Réseaux', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'C1', 'teacher_name' => 'Paul Bernard'],
            ['group_code' => 'INF-L1-B', 'title' => 'Système Linux', 'day' => 'Mercredi', 'slot' => '11:00', 'room' => 'B3', 'teacher_name' => 'Franck Vincent'],
            ['group_code' => 'INF-L1-B', 'title' => 'Développement Web', 'day' => 'Jeudi', 'slot' => '08:30', 'room' => 'A1', 'teacher_name' => 'Luc Blanc'],
            ['group_code' => 'INF-L1-B', 'title' => 'Anglais technique', 'day' => 'Jeudi', 'slot' => '11:00', 'room' => 'B4', 'teacher_name' => 'Valérie Leclerc'],
            ['group_code' => 'INF-L1-B', 'title' => 'Architecture ordinateurs', 'day' => 'Vendredi', 'slot' => '13:30', 'room' => 'A4', 'teacher_name' => 'Olivier Guillot'],

            ['group_code' => 'INF-L1-C', 'title' => 'Programmation PHP', 'day' => 'Mardi', 'slot' => '11:00', 'room' => 'A1', 'teacher_name' => 'Marie Dupont'],
            ['group_code' => 'INF-L1-C', 'title' => 'Algorithmique', 'day' => 'Mardi', 'slot' => '16:00', 'room' => 'B2', 'teacher_name' => 'Sophie Petit'],
            ['group_code' => 'INF-L1-C', 'title' => 'Bases de données', 'day' => 'Mercredi', 'slot' => '13:30', 'room' => 'A2', 'teacher_name' => 'Jean Martin'],
            ['group_code' => 'INF-L1-C', 'title' => 'Réseaux', 'day' => 'Jeudi', 'slot' => '11:00', 'room' => 'C2', 'teacher_name' => 'Paul Bernard'],
            ['group_code' => 'INF-L1-C', 'title' => 'Système Linux', 'day' => 'Vendredi', 'slot' => '08:30', 'room' => 'B3', 'teacher_name' => 'Franck Vincent'],

            ['group_code' => 'GES-L1-A', 'title' => 'Comptabilité générale', 'day' => 'Lundi', 'slot' => '08:30', 'room' => 'D1', 'teacher_name' => 'Claude Lefevre'],
            ['group_code' => 'GES-L1-A', 'title' => 'Droit commercial', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'D2', 'teacher_name' => 'Anne Richard'],
            ['group_code' => 'GES-L1-A', 'title' => 'Économie générale', 'day' => 'Mardi', 'slot' => '08:30', 'room' => 'D3', 'teacher_name' => 'Nathalie Fournier'],
            ['group_code' => 'GES-L1-A', 'title' => 'Mathématiques financières', 'day' => 'Mercredi', 'slot' => '11:00', 'room' => 'D1', 'teacher_name' => 'Stéphane Arnould'],
            ['group_code' => 'GES-L1-A', 'title' => 'Gestion ressources', 'day' => 'Jeudi', 'slot' => '13:30', 'room' => 'D2', 'teacher_name' => 'Valérie Leclerc'],

            ['group_code' => 'GES-L1-B', 'title' => 'Comptabilité analytique', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'D1', 'teacher_name' => 'Claude Lefevre'],
            ['group_code' => 'GES-L1-B', 'title' => 'Droit du travail', 'day' => 'Mardi', 'slot' => '11:00', 'room' => 'D2', 'teacher_name' => 'Michel Thomas'],
            ['group_code' => 'GES-L1-B', 'title' => 'Économie générale', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'D3', 'teacher_name' => 'Nathalie Fournier'],
            ['group_code' => 'GES-L1-B', 'title' => 'Statistiques', 'day' => 'Jeudi', 'slot' => '11:00', 'room' => 'D1', 'teacher_name' => 'Stéphane Arnould'],
            ['group_code' => 'GES-L1-B', 'title' => 'Gestion projet', 'day' => 'Vendredi', 'slot' => '13:30', 'room' => 'D4', 'teacher_name' => 'Anne Richard'],

            ['group_code' => 'MEC-L1-A', 'title' => 'Dessin technique', 'day' => 'Lundi', 'slot' => '08:30', 'room' => 'E1', 'teacher_name' => 'Michel Thomas'],
            ['group_code' => 'MEC-L1-A', 'title' => 'Mécanique générale', 'day' => 'Mardi', 'slot' => '08:30', 'room' => 'E2', 'teacher_name' => 'Jacques Moreau'],
            ['group_code' => 'MEC-L1-A', 'title' => 'Thermodynamique', 'day' => 'Mercredi', 'slot' => '13:30', 'room' => 'E3', 'teacher_name' => 'Robert Durand'],
            ['group_code' => 'MEC-L1-A', 'title' => 'Matériaux', 'day' => 'Jeudi', 'slot' => '08:30', 'room' => 'E4', 'teacher_name' => 'Pierre Mercier'],
            ['group_code' => 'MEC-L1-A', 'title' => 'CAO Solidworks', 'day' => 'Vendredi', 'slot' => '11:00', 'room' => 'E1', 'teacher_name' => 'Michel Thomas'],

            ['group_code' => 'RES-L1-A', 'title' => 'Protocoles réseau', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'F1', 'teacher_name' => 'Paul Bernard'],
            ['group_code' => 'RES-L1-A', 'title' => 'Sécurité réseau', 'day' => 'Mardi', 'slot' => '13:30', 'room' => 'F2', 'teacher_name' => 'Jean Martin'],
            ['group_code' => 'RES-L1-A', 'title' => 'Administration serveurs', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'F3', 'teacher_name' => 'Luc Blanc'],
            ['group_code' => 'RES-L1-A', 'title' => 'Cybersécurité', 'day' => 'Jeudi', 'slot' => '16:00', 'room' => 'F1', 'teacher_name' => 'Franck Vincent'],
            ['group_code' => 'RES-L1-A', 'title' => 'Télécommunications', 'day' => 'Vendredi', 'slot' => '08:30', 'room' => 'F2', 'teacher_name' => 'Olivier Guillot'],

            ['group_code' => 'MKT-L1-A', 'title' => 'Stratégie marketing', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'G1', 'teacher_name' => 'Sophie Petit'],
            ['group_code' => 'MKT-L1-A', 'title' => 'E-commerce', 'day' => 'Mardi', 'slot' => '16:00', 'room' => 'G2', 'teacher_name' => 'Anne Richard'],
            ['group_code' => 'MKT-L1-A', 'title' => 'Réseaux sociaux', 'day' => 'Mercredi', 'slot' => '11:00', 'room' => 'G1', 'teacher_name' => 'Isabelle Laurent'],
            ['group_code' => 'MKT-L1-A', 'title' => 'Analyse données', 'day' => 'Jeudi', 'slot' => '13:30', 'room' => 'G2', 'teacher_name' => 'Nathalie Fournier'],
            ['group_code' => 'MKT-L1-A', 'title' => 'Content marketing', 'day' => 'Vendredi', 'slot' => '16:00', 'room' => 'G1', 'teacher_name' => 'Sophie Petit'],

            ['group_code' => 'RH-L1-A', 'title' => 'Droit du travail', 'day' => 'Lundi', 'slot' => '16:00', 'room' => 'H1', 'teacher_name' => 'Michel Thomas'],
            ['group_code' => 'RH-L1-A', 'title' => 'Rémunération', 'day' => 'Mercredi', 'slot' => '16:00', 'room' => 'H2', 'teacher_name' => 'Valérie Leclerc'],
            ['group_code' => 'RH-L1-A', 'title' => 'Recrutement', 'day' => 'Jeudi', 'slot' => '11:00', 'room' => 'H1', 'teacher_name' => 'Stéphane Arnould'],
            ['group_code' => 'RH-L1-A', 'title' => 'Formation', 'day' => 'Vendredi', 'slot' => '11:00', 'room' => 'H2', 'teacher_name' => 'Catherine Adam'],

            ['group_code' => 'FC-L1-A', 'title' => 'Analyse financière', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'I1', 'teacher_name' => 'Jacques Moreau'],
            ['group_code' => 'FC-L1-A', 'title' => 'Audit', 'day' => 'Mardi', 'slot' => '08:30', 'room' => 'I2', 'teacher_name' => 'Claude Lefevre'],
            ['group_code' => 'FC-L1-A', 'title' => 'Fiscalité', 'day' => 'Mercredi', 'slot' => '13:30', 'room' => 'I1', 'teacher_name' => 'Anne Richard'],
            ['group_code' => 'FC-L1-A', 'title' => 'Trésorerie', 'day' => 'Jeudi', 'slot' => '16:00', 'room' => 'I2', 'teacher_name' => 'Nathalie Fournier'],
            ['group_code' => 'FC-L1-A', 'title' => 'Gestion budgétaire', 'day' => 'Vendredi', 'slot' => '13:30', 'room' => 'I1', 'teacher_name' => 'Stéphane Arnould'],

            ['group_code' => 'INF-L2-A', 'title' => 'Programmation objet', 'day' => 'Lundi', 'slot' => '08:30', 'room' => 'A1', 'teacher_name' => 'Marie Dupont'],
            ['group_code' => 'INF-L2-A', 'title' => 'Bases de données avancées', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'A2', 'teacher_name' => 'Jean Martin'],
            ['group_code' => 'INF-L2-A', 'title' => 'Sécurité réseaux', 'day' => 'Mardi', 'slot' => '08:30', 'room' => 'C3', 'teacher_name' => 'Paul Bernard'],
            ['group_code' => 'INF-L2-A', 'title' => 'Systèmes distribués', 'day' => 'Mercredi', 'slot' => '13:30', 'room' => 'A3', 'teacher_name' => 'Luc Blanc'],
            ['group_code' => 'INF-L2-A', 'title' => 'Web services', 'day' => 'Jeudi', 'slot' => '08:30', 'room' => 'A2', 'teacher_name' => 'Franck Vincent'],

            ['group_code' => 'INF-L2-B', 'title' => 'Programmation objet', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'B1', 'teacher_name' => 'Dupont Marie'],
            ['group_code' => 'INF-L2-B', 'title' => 'Bases de données avancées', 'day' => 'Mardi', 'slot' => '11:00', 'room' => 'B2', 'teacher_name' => 'Martin Jean'],
            ['group_code' => 'INF-L2-B', 'title' => 'Sécurité réseaux', 'day' => 'Mardi', 'slot' => '13:30', 'room' => 'C3', 'teacher_name' => 'Bernard Paul'],
            ['group_code' => 'INF-L2-B', 'title' => 'Systèmes distribués', 'day' => 'Jeudi', 'slot' => '11:00', 'room' => 'B3', 'teacher_name' => 'Blanc Luc'],
            ['group_code' => 'INF-L2-B', 'title' => 'Web services', 'day' => 'Vendredi', 'slot' => '08:30', 'room' => 'B2', 'teacher_name' => 'Vincent Franck'],

            ['group_code' => 'INF-L3-A', 'title' => 'Architecture logiciels', 'day' => 'Lundi', 'slot' => '08:30', 'room' => 'A1', 'teacher_name' => 'Guillot Olivier'],
            ['group_code' => 'INF-L3-A', 'title' => 'Intelligence artificielle', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'A4', 'teacher_name' => 'Dupont Marie'],
            ['group_code' => 'INF-L3-A', 'title' => 'Cloud computing', 'day' => 'Jeudi', 'slot' => '13:30', 'room' => 'A3', 'teacher_name' => 'Martin Jean'],
            ['group_code' => 'INF-L3-A', 'title' => 'Projet innovation', 'day' => 'Vendredi', 'slot' => '11:00', 'room' => 'B1', 'teacher_name' => 'Bernard Paul'],

            ['group_code' => 'GES-L2-A', 'title' => 'Management', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'D1', 'teacher_name' => 'Lefevre Claude'],
            ['group_code' => 'GES-L2-A', 'title' => 'Comptabilité contrôle', 'day' => 'Mardi', 'slot' => '08:30', 'room' => 'D2', 'teacher_name' => 'Richard Anne'],
            ['group_code' => 'GES-L2-A', 'title' => 'Fiscalité entreprise', 'day' => 'Mercredi', 'slot' => '16:00', 'room' => 'D1', 'teacher_name' => 'Fournier Nathalie'],
            ['group_code' => 'GES-L2-A', 'title' => 'Stratégie', 'day' => 'Jeudi', 'slot' => '08:30', 'room' => 'D3', 'teacher_name' => 'Arnould Stéphane'],

            ['group_code' => 'GES-L2-B', 'title' => 'Management', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'D1', 'teacher_name' => 'Lefevre Claude'],
            ['group_code' => 'GES-L2-B', 'title' => 'Comptabilité contrôle', 'day' => 'Mardi', 'slot' => '13:30', 'room' => 'E2', 'teacher_name' => 'Richard Anne'],
            ['group_code' => 'GES-L2-B', 'title' => 'Fiscalité entreprise', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'D2', 'teacher_name' => 'Fournier Nathalie'],
            ['group_code' => 'GES-L2-B', 'title' => 'Stratégie', 'day' => 'Vendredi', 'slot' => '11:00', 'room' => 'E1', 'teacher_name' => 'Arnould Stéphane'],

            ['group_code' => 'MEC-L2-A', 'title' => 'Résistance des matériaux', 'day' => 'Lundi', 'slot' => '08:30', 'room' => 'F1', 'teacher_name' => 'Moreau Jacques'],
            ['group_code' => 'MEC-L2-A', 'title' => 'Thermodynamique avancée', 'day' => 'Mardi', 'slot' => '11:00', 'room' => 'F2', 'teacher_name' => 'Leclerc Valérie'],
            ['group_code' => 'MEC-L2-A', 'title' => 'Pneumatique hydraulique', 'day' => 'Mercredi', 'slot' => '13:30', 'room' => 'F1', 'teacher_name' => 'Petit Sophie'],
            ['group_code' => 'MEC-L2-A', 'title' => 'Fabrication', 'day' => 'Jeudi', 'slot' => '08:30', 'room' => 'F3', 'teacher_name' => 'Thomas Michel'],

            ['group_code' => 'RES-L2-A', 'title' => 'Protocoles TCP/IP', 'day' => 'Lundi', 'slot' => '16:00', 'room' => 'C1', 'teacher_name' => 'Bernard Paul'],
            ['group_code' => 'RES-L2-A', 'title' => 'Sécurité avancée', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'C2', 'teacher_name' => 'Blanc Luc'],
            ['group_code' => 'RES-L2-A', 'title' => 'Infrastructure IT', 'day' => 'Jeudi', 'slot' => '11:00', 'room' => 'C3', 'teacher_name' => 'Vincent Franck'],
            ['group_code' => 'RES-L2-A', 'title' => 'Gestion réseau', 'day' => 'Vendredi', 'slot' => '16:00', 'room' => 'C1', 'teacher_name' => 'Guillot Olivier'],

            ['group_code' => 'MKT-L2-A', 'title' => 'Marketing digital avancé', 'day' => 'Lundi', 'slot' => '11:00', 'room' => 'G1', 'teacher_name' => 'Adam Catherine'],
            ['group_code' => 'MKT-L2-A', 'title' => 'Analyse données', 'day' => 'Mardi', 'slot' => '16:00', 'room' => 'G2', 'teacher_name' => 'Petit Sophie'],
            ['group_code' => 'MKT-L2-A', 'title' => 'Brands management', 'day' => 'Mercredi', 'slot' => '11:00', 'room' => 'G1', 'teacher_name' => 'Thomas Michel'],
            ['group_code' => 'MKT-L2-A', 'title' => 'Négociation commerciale', 'day' => 'Jeudi', 'slot' => '16:00', 'room' => 'G3', 'teacher_name' => 'Leclerc Valérie'],

            ['group_code' => 'RH-L2-A', 'title' => 'Gestion des talents', 'day' => 'Lundi', 'slot' => '13:30', 'room' => 'H1', 'teacher_name' => 'Arnould Stéphane'],
            ['group_code' => 'RH-L2-A', 'title' => 'Motivation et QVT', 'day' => 'Mercredi', 'slot' => '08:30', 'room' => 'H2', 'teacher_name' => 'Adam Catherine'],
            ['group_code' => 'RH-L2-A', 'title' => 'SIRH et digitalisation', 'day' => 'Vendredi', 'slot' => '13:30', 'room' => 'H1', 'teacher_name' => 'Moreau Jacques'],

            ['group_code' => 'FC-L2-A', 'title' => 'Gestion financière avancée', 'day' => 'Mardi', 'slot' => '11:00', 'room' => 'I1', 'teacher_name' => 'Fournier Nathalie'],
            ['group_code' => 'FC-L2-A', 'title' => 'Droit fiscal', 'day' => 'Mercredi', 'slot' => '16:00', 'room' => 'I2', 'teacher_name' => 'Richard Anne'],
            ['group_code' => 'FC-L2-A', 'title' => 'Normes comptables', 'day' => 'Jeudi', 'slot' => '13:30', 'room' => 'I1', 'teacher_name' => 'Lefevre Claude'],
            ['group_code' => 'FC-L2-A', 'title' => 'Études de cas', 'day' => 'Vendredi', 'slot' => '08:30', 'room' => 'I2', 'teacher_name' => 'Moreau Jacques'],
        ];

        foreach ($schedules as $schedule) {
            $group = $groups->first(fn($g) => $g->code === $schedule['group_code']);
            $teacher = $teachers->first(fn($t) => $t->full_name === $schedule['teacher_name']);
            $room = $rooms->first(fn($r) => $r->name === $schedule['room']);

            if (!$group || !$teacher || !$room) {
                continue;
            }

            Schedule::create([
                'group_id' => $group->id,
                'filiere_id' => $group->filiere_id,
                'title' => $schedule['title'],
                'day' => $schedule['day'],
                'start_time' => $schedule['slot'],
                'end_time' => $slots[$schedule['slot']],
                'room_id' => $room->id,
                'teacher_id' => $teacher->id,
            ]);
        }
    }
}