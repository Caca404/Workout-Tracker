<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'difficulty',
        'is_template',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class)
            ->withPivot([
                'sets',
                'reps',
                'weight',
                'rest_seconds',
                'order'
            ]);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function workoutSessions()
    {
        return $this->hasMany(WorkoutSession::class);
    }
}
