<?php

namespace App\Models;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}