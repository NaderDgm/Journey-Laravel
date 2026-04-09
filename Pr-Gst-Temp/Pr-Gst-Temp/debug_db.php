<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Teacher;
use App\Models\Room;
use App\Models\Schedule;

echo "=== Database Check ===\n";
echo "Total Teachers: " . Teacher::count() . "\n";
echo "Total Rooms: " . Room::count() . "\n";
echo "Total Schedules: " . Schedule::count() . "\n\n";

echo "Teacher ID 1: " . (Teacher::find(1)?->full_name ?? 'NOT FOUND') . "\n";
echo "Room ID 1: " . (Room::find(1)?->name ?? 'NOT FOUND') . "\n\n";

$schedule = Schedule::find(1);
if ($schedule) {
    echo "Schedule ID 1: " . $schedule->title . "\n";
    echo "- Teacher ID: " . $schedule->teacher_id . "\n";
    echo "- Teacher: " . Teacher::find($schedule->teacher_id)?->full_name . "\n";
    echo "- Room ID: " . $schedule->room_id . "\n";
    echo "- Room: " . Room::find($schedule->room_id)?->name . "\n";
}