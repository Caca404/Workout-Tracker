<?php

use App\Enums\WorkoutSessionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_sessions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('plan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('schedule_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('status', [
                'running',
                'completed',
                'abandoned',
            ])->default('running');

            $table->timestamp('started_at');

            $table->timestamp('finished_at')
                ->nullable();

            $table->unsignedInteger('late_minutes')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_sessions');
    }
};