<?php

use App\Http\Controllers\FiliereController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('emploi-du-temps', ScheduleController::class)
        ->parameters(['emploi-du-temps' => 'schedule'])
        ->names('schedules')
        ->except(['show']);

    Route::get('/emploi-du-temps/export/csv', [ScheduleController::class, 'exportCsv'])->name('schedules.export.csv');
    Route::get('/emploi-du-temps/export/pdf', [ScheduleController::class, 'exportPdf'])->name('schedules.export.pdf');

    Route::middleware('admin')->group(function () {
        Route::resource('filieres', FiliereController::class);
        Route::resource('groups', GroupController::class)->except(['show']);
        Route::resource('rooms', RoomController::class)->except(['show']);
        Route::resource('teachers', TeacherController::class)->except(['show']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';