<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}