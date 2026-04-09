<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Schedule;

echo "=== TEST 1: ACCESSOR WITH LOADED RELATIONSHIP ===\n";
$schedule = Schedule::with(['teacher', 'room'])->first();
echo "Schedule ID: " . $schedule->id . "\n";
echo "Teacher ID: " . $schedule->teacher_id . "\n";
echo "Teacher name (accessor): " . ($schedule->teacher_name ?? 'NULL') . "\n";
echo "Room name (accessor): " . ($schedule->room_name ?? 'NULL') . "\n";

echo "\n=== TEST 2: ACCESSOR WITH LOADED COLLECTION ===\n";
$schedules = Schedule::limit(3)->get();
$schedules->load(['teacher', 'room']);
foreach ($schedules as $s) {
    echo "Schedule {$s->id} - Teacher: " . ($s->teacher_name ?? 'NULL') . " / Room: " . ($s->room_name ?? 'NULL') . "\n";
}