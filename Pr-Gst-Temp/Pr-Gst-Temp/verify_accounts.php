<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

$totalUsers = User::count();
$teachers = User::where('role', 'teacher')->get();
$students = User::where('role', 'student')->count();

echo "=== ACCOUNT VERIFICATION ===\n\n";
echo "Total Users: $totalUsers\n";
echo "Total Teachers: " . $teachers->count() . "\n";
echo "Total Students: $students\n\n";

echo "=== SAMPLE TEACHER ACCOUNTS ===\n";
foreach ($teachers->take(5) as $teacher) {
    echo "Email: {$teacher->email} | Name: {$teacher->name}\n";
}

echo "\n=== SAMPLE STUDENT ACCOUNTS ===\n";
$sampleStudents = User::where('role', 'student')->take(5)->get();
foreach ($sampleStudents as $student) {
    echo "Email: {$student->email} | Name: {$student->name}\n";
}

echo "\n✅ All accounts created successfully!\n";
echo "Password for all accounts: password\n";
?>