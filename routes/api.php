<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);

        Route::post('/login', [AuthController::class, 'login'])
            ->middleware('throttle:login');

        Route::post('/forgot-password', [AuthController::class, 'forgot'])
            ->middleware('throttle:forgot-password');

        Route::post('/reset-password', [AuthController::class, 'resetPassword'])
            ->middleware('throttle:reset-password');
    });

    Route::middleware('auth:api')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/profile', [ProfileController::class, 'show']);
        Route::put('/profile', [ProfileController::class, 'update']);

        Route::get('/exercises', [ExerciseController::class, 'index']);

        Route::get('/report', [ReportController::class, 'index']);

        Route::prefix('/plans')->group(function () {
            Route::get('/', [PlanController::class, 'index']);
            Route::post('/', [PlanController::class, 'store']);
            Route::put('/{idPlan}', [PlanController::class, 'update']);
            Route::delete('/{idPlan}', [PlanController::class, 'remove']);
        });

        Route::prefix('/schedules')->group(function () {
            Route::get('/', [ScheduleController::class, 'index']);
            Route::post('/', [ScheduleController::class, 'store']);
            Route::put('/{idSchedule}', [ScheduleController::class, 'update']);
            Route::delete('/{idSchedule}', [ScheduleController::class, 'remove']);
        });
    });
});
