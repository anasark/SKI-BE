<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClosingPeriodRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'period'    => 'required|string|size:7|unique:closing_periods,period',
            'is_locked' => 'boolean',
            'locked_by' => 'nullable|integer',
            'locked_at' => 'nullable|date',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['period'] = 'sometimes|string|size:7|unique:closing_periods,period,' . $this->route('closing_period')->id;
        }

        return $rules;
    }
}
