<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Schedule;

$schedules = Schedule::with(['group.filiere', 'room', 'teacher'])->get();

echo "=== CSV EXPORT TEST ===\n";
echo "CSV Header: Filière,Intitulé,Jour,Début,Fin,Salle,Enseignant\n";
$count = 0;
foreach ($schedules->take(5) as $schedule) {
    $csv = [
        $schedule->filiere->name ?? '-',
        $schedule->title,
        $schedule->day,
        substr($schedule->start_time, 0, 5),
        substr($schedule->end_time, 0, 5),
        $schedule->room_name ?? '-',
        $schedule->teacher_name ?? '-',
    ];
    echo implode(',', $csv) . "\n";
    $count++;
}

echo "\n=== PDF TABLE TEST ===\n";
$times = $schedules->pluck('start_time')->unique()->sort()->values();
echo "Total time slots: " . $times->count() . "\n";
echo "Sample schedule cells:\n";

$grouped = $schedules->groupBy('day');
$lundi = $grouped->get('Lundi') ?? collect();

foreach ($times->take(2) as $time) {
    $schedule = $lundi->where('start_time', $time)->first();
    if ($schedule) {
        echo "Monday {$time}: {$schedule->title} / Teacher: {$schedule->teacher_name} / Room: {$schedule->room_name}\n";
    }
}