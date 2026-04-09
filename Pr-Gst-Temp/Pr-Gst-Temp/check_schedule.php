<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Schedule;

$schedule = Schedule::with(['teacher', 'room', 'group.filiere'])->first();

echo "Schedule Details:\n";
echo "- Title: " . $schedule->title . "\n";
echo "- Teacher ID: " . $schedule->teacher_id . "\n";
echo "- Teacher Name (from relation): " . ($schedule->teacher?->full_name ?? 'NULL') . "\n";
echo "- Teacher Name (accessor): " . $schedule->teacher_name . "\n";
echo "- Room ID: " . $schedule->room_id . "\n";
echo "- Room Name (from relation): " . ($schedule->room?->name ?? 'NULL') . "\n";
echo "- Room Name (accessor): " . $schedule->room_name . "\n";
echo "- Group: " . $schedule->group->code . "\n";
echo "- Filiere: " . $schedule->group->filiere->name . "\n";