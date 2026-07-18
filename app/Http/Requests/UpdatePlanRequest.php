<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',

            'description' => 'nullable|string',

            'difficulty' => 'sometimes|in:beginner,intermediate,advanced',

            'exercises' => 'sometimes|array',

            'exercises.*.id' => 'required_with:exercises|exists:exercises,id',

            'exercises.*.sets' => 'required_with:exercises|integer|min:1',

            'exercises.*.reps' => 'required_with:exercises|integer|min:1',

            'exercises.*.weight' => 'nullable|numeric|min:0',

            'exercises.*.rest_seconds' => 'nullable|integer|min:0',

            'exercises.*.order' => 'nullable|integer|min:1',
        ];
    }
}
