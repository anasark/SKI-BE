<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChartOfAccountRequest extends FormRequest
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
            'code'           => 'required|string|max:10|unique:chart_of_accounts,code',
            'name'           => 'required|string|max:100',
            'normal_balance' => 'required|in:DR,CR',
            'is_active'      => 'boolean',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules = [
                'code'           => 'sometimes|string|max:10|unique:chart_of_accounts,code,' . $this->route('chart_of_account')->id,
                'name'           => 'sometimes|string|max:100',
                'normal_balance' => 'sometimes|in:DR,CR',
                'is_active'      => 'sometimes|boolean',
            ];
        }

        return $rules;
    }
}
