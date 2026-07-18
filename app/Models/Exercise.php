<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function muscleGroups()
    {
        return $this->belongsToMany(MuscleGroup::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class)
            ->withPivot([
                'sets',
                'reps',
                'weight',
                'rest_seconds',
                'order'
            ]);
    }
}
