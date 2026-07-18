<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlanRequest;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePlanRequest;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        return Plan::query()
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhere('is_template', true);
            })
            ->with('exercises')
            ->get();
    }

    public function show(Plan $plan)
    {
        return $plan->load('exercises');
    }

    public function store(CreatePlanRequest $request): JsonResponse
    {
        $plan = Plan::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'difficulty' => $request->difficulty,
            'is_template' => false,
        ]);

        foreach ($request->exercises as $index => $exercise) {
            $plan->exercises()->attach($exercise['id'], [
                'sets' => $exercise['sets'],
                'reps' => $exercise['reps'],
                'weight' => $exercise['weight'] ?? null,
                'rest_seconds' => $exercise['rest_seconds'] ?? 60,
                'order' => $index + 1,
            ]);
        }

        return response()->json($plan->load('exercises'), 201);
    }

    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $validated = $request->validated();

        $plan->update([
            'name' => $validated['name'] ?? $plan->name,
            'slug' => Str::slug($validated['name'] ?? $plan->name),
            'description' => $validated['description'] ?? $plan->description,
            'difficulty' => $validated['difficulty'] ?? $plan->difficulty,
        ]);

        if (isset($validated['exercises'])) {

            $syncData = [];

            foreach ($validated['exercises'] as $exercise) {

                $syncData[$exercise['id']] = [
                    'sets' => $exercise['sets'],
                    'reps' => $exercise['reps'],
                    'weight' => $exercise['weight'] ?? null,
                    'rest_seconds' => $exercise['rest_seconds'] ?? 60,
                    'order' => $exercise['order'] ?? 1,
                ];
            }

            $plan->exercises()->sync($syncData);
        }

        return response()->json($plan->load('exercises'));
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json(['message' => 'Plano removido com sucesso']);
    }
}
