<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filiere_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->enum('day', ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche']);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room')->nullable();
            $table->string('teacher')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};