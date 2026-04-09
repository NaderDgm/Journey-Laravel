<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'code',
        'filiere_id',
        'year',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}