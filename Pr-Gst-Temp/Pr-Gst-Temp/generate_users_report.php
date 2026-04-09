<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Teacher;
use App\Models\Group;
use App\Models\Schedule;

$output = fopen('php://output', 'w');

fwrite($output, "========================================\n");
fwrite($output, "FORMATEURS (TEACHERS) LOGIN CREDENTIALS\n");
fwrite($output, "========================================\n\n");

fwrite($output, "Password: password (for all accounts)\n");
fwrite($output, "All teachers see only THEIR assigned courses\n\n");

$teachers = Teacher::orderBy('last_name')->orderBy('first_name')->get();
foreach ($teachers as $teacher) {
    $user = User::where('teacher_id', $teacher->id)->first();
    if ($user) {
        $schedules = Schedule::where('teacher_id', $teacher->id)->orderBy('day')->orderBy('start_time')->get();
        fwrite($output, "Email: " . $user->email . "\n");
        fwrite($output, "Name: " . $teacher->full_name . "\n");
        fwrite($output, "Courses: " . $schedules->count() . "\n");
        if ($schedules->count() > 0) {
            foreach ($schedules as $schedule) {
                fwrite($output, "  • " . $schedule->day . " " . $schedule->start_time . "-" . $schedule->end_time . ": "
                    . $schedule->title . " (Group: " . $schedule->group->code . ")\n");
            }
        }
        fwrite($output, "\n");
    }
}

fwrite($output, "\n========================================\n");
fwrite($output, "ETUDIANTS (STUDENTS) LOGIN CREDENTIALS\n");
fwrite($output, "========================================\n\n");

fwrite($output, "Password: password (for all accounts)\n");
fwrite($output, "Each student sees only their GROUP's timetable\n\n");

$groups = Group::with('filiere')->orderBy('code')->get();
foreach ($groups as $group) {
    $students = User::where('group_id', $group->id)->get();
    if ($students->count() > 0) {
        fwrite($output, "GROUP: " . $group->code . " (" . $group->filiere->name . " - Year " . $group->year . ")\n");
        fwrite($output, "Total students: " . $students->count() . "\n");
        fwrite($output, "Sample emails: ");
        fwrite($output, implode(", ", $students->take(3)->pluck('email')->toArray()) . "\n");

        $schedules = Schedule::where('group_id', $group->id)->orderBy('day')->orderBy('start_time')->get();
        fwrite($output, "Timetable (" . $schedules->count() . " courses):\n");
        if ($schedules->count() > 0) {
            foreach ($schedules as $schedule) {
                fwrite($output, "  • " . $schedule->day . " " . $schedule->start_time . "-" . $schedule->end_time . ": "
                    . $schedule->title . " (" . $schedule->teacher_name . ")\n");
            }
        }
        fwrite($output, "\n");
    }
}

fclose($output);