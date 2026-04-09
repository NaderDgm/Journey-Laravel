<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'group_id',
        'filiere_id',
        'title',
        'day',
        'start_time',
        'end_time',
        'room',
        'teacher',
        'room_id',
        'teacher_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getRoomNameAttribute(): ?string
    {

        $room = $this->getRelation('room');
        return $room?->name ?? null;
    }

    public function getTeacherNameAttribute(): ?string
    {

        $teacher = $this->getRelation('teacher');
        return $teacher?->full_name ?? null;
    }
}