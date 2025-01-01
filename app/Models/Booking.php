<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'space_id',
        'lecturer_id',
        'date',
        'start_time',
        'end_time',
        'purpose',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
}

