<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'Filieres: '.App\Models\Filiere::count()."\n";
echo 'Schedules: '.App\Models\Schedule::count()."\n";