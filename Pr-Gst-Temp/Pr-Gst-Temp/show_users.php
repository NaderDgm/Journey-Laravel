<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Teacher;
use App\Models\Group;
use App\Models\Schedule;

echo "\n========================================\n";
echo "FORMATEURS (TEACHERS) & THEIR SCHEDULES\n";
echo "========================================\n\n";

$teachers = Teacher::all();
foreach ($teachers as $teacher) {
    $user = User::where('teacher_id', $teacher->id)->first();
    if ($user) {
        echo "Email: " . $user->email . "\n";
        echo "Name: " . $teacher->full_name . "\n";

        $schedules = Schedule::where('teacher_id', $teacher->id)->orderBy('day')->orderBy('start_time')->get();
        if ($schedules->count() > 0) {
            echo "Emploi du temps:\n";
            foreach ($schedules as $schedule) {
                echo "  - " . $schedule->day . " " . $schedule->start_time . "-" . $schedule->end_time . ": " . $schedule->title . " (Groupe: " . $schedule->group->code . ")\n";
            }
        } else {
            echo "Aucun cours assigné\n";
        }
        echo "\n";
    }
}

echo "\n========================================\n";
echo "ETUDIANTS (STUDENTS) & THEIR GROUPS\n";
echo "========================================\n\n";

$groups = Group::with('filiere')->orderBy('code')->get();
foreach ($groups as $group) {
    $students = User::where('group_id', $group->id)->take(3)->get();
    if ($students->count() > 0) {
        echo "Groupe: " . $group->code . " (" . $group->filiere->name . " - Année " . $group->year . ")\n";
        foreach ($students as $student) {
            echo "  Email: " . $student->email . "\n";
        }

        $schedules = Schedule::where('group_id', $group->id)->orderBy('day')->orderBy('start_time')->get();
        if ($schedules->count() > 0) {
            echo "  Emploi du temps du groupe:\n";
            foreach ($schedules as $schedule) {
                echo "    - " . $schedule->day . " " . $schedule->start_time . "-" . $schedule->end_time . ": " . $schedule->title . " (" . $schedule->teacher_name . ")\n";
            }
        }
        echo "\n";
    }
}