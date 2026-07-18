<?php

namespace App\Models;

use App\Enums\WorkoutSessionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'schedule_id',
        'status',
        'started_at',
        'finished_at',
        'late_minutes',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'status' => WorkoutSessionStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}