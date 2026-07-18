<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\WorkoutSession;
use App\Http\Requests\StartWorkoutSessionRequest;
use App\Http\Requests\FinishWorkoutSessionRequest;
use App\Http\Requests\CancelWorkoutSessionRequest;
use App\WorkoutSessionStatus;
use Illuminate\Support\Facades\DB;

class WorkoutSessionController extends Controller
{
    public function start(StartWorkoutSessionRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $schedule = Schedule::query()
                ->lockForUpdate()
                ->findOrFail($request->schedule_id);

            abort_if(
                $schedule->user_id !== auth()->id(),
                403
            );

            abort_if(
                $schedule->workoutSession()->exists(),
                409,
                'Workout already started.'
            );

            abort_if(
                $schedule->scheduled_at->copy()->addHours(3)->isPast(),
                422,
                'Workout session expired.'
            );

            $lateMinutes = max(
                now()->diffInMinutes(
                    $schedule->scheduled_at,
                    false
                ) * -1,
                0
            );

            $session = WorkoutSession::create([
                'user_id' => auth()->id(),
                'plan_id' => $schedule->plan_id,
                'schedule_id' => $schedule->id,
                'started_at' => now(),
                'late_minutes' => $lateMinutes,
                'status' => WorkoutSessionStatus::Running,
            ]);

            return response()->json(
                $session->load('plan', 'schedule'),
                201
            );
        });
    }

    public function finish(FinishWorkoutSessionRequest $request, WorkoutSession $workoutSession)
    {
        abort_if(
            $workoutSession->user_id !== auth()->id(),
            403
        );

        abort_if(
            $workoutSession->finished_at,
            409
        );

        abort_unless(
            $workoutSession->status === WorkoutSessionStatus::Running,
            409,
            'Workout is not running.'
        );

        $workoutSession->update([
            'status' => WorkoutSessionStatus::Completed,
            'finished_at' => now(),
        ]);

        return response()->json($workoutSession);
    }

    public function abandon(CancelWorkoutSessionRequest $request, WorkoutSession $workoutSession)
    {
        abort_if(
            $workoutSession->user_id !== auth()->id(),
            403
        );

        abort_if(
            $workoutSession->finished_at,
            409
        );

        abort_unless(
            $workoutSession->status === WorkoutSessionStatus::Running,
            409,
            'Workout is not running.'
        );

        $workoutSession->update([
            'status' => WorkoutSessionStatus::Abandoned,
            'finished_at' => now(),
        ]);

        return response()->json($workoutSession);
    }
}
