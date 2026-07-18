<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartWorkoutSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'schedule_id' => 'required|exists:schedules,id'
        ];
    }
}