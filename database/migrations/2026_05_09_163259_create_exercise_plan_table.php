<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_plan', function (Blueprint $table) {

            $table->foreignId('exercise_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('plan_id')
                ->constrained()
                ->cascadeOnDelete();

            // Configuração do exercício no treino
            $table->unsignedTinyInteger('sets');

            $table->unsignedTinyInteger('reps');

            $table->decimal('weight', 5, 2)
                ->nullable();

            $table->unsignedSmallInteger('rest_seconds')
                ->default(60);

            // Ordem do exercício no treino
            $table->unsignedTinyInteger('order')
                ->default(1);

            $table->timestamps();

            $table->primary([
                'exercise_id',
                'plan_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_plan');
    }
};
