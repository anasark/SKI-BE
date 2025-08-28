<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalLineRequest extends FormRequest
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
        return [
            'journal_id' => 'required|exists:journals,id',
            'account_id' => 'required|exists:chart_of_accounts,id',
            'dept_id'    => 'nullable|integer',
            'debit'      => 'numeric|min:0',
            'credit'     => 'numeric|min:0',
        ];
    }
}
