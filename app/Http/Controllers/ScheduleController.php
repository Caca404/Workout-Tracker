<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Plan;
use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::query()
            ->where('user_id', auth()->id())
            ->orWhere('plan_id', function ($query) {
                $query->select('id')
                    ->from('plans')
                    ->where('is_template', true);
            })
            ->with('plan')
            ->orderBy('scheduled_at')
            ->get();
    }

    public function store(CreateScheduleRequest $request)
    {
        $plan = Plan::findOrFail($request->plan_id);

        abort_if($plan->user_id !== auth()->id() && !$plan->is_template, 403, 'You cannot schedule another user\'s plan.');

        $schedule = Schedule::create([
            'user_id' => auth()->id(),
            'plan_id' => $request->plan_id,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return response()->json(
            $schedule->load('plan'),
            201
        );
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        abort_if($schedule->user_id !== auth()->id(), 403, 'You cannot update another user\'s schedule.');

        $schedule->update($request->validated());

        return $schedule->load('plan');
    }

    public function destroy(Schedule $schedule)
    {
        abort_if($schedule->user_id !== auth()->id(), 403, 'You cannot delete another user\'s schedule.');

        $schedule->delete();

        return response()->json([
            'message' => 'Treino removido da agenda.'
        ]);
    }
}
