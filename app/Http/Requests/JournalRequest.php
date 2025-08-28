<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
            'ref_no'       => 'required|string|max:20|unique:journals,ref_no',
            'posting_date' => 'required|date',
            'memo'         => 'nullable|string|max:255',
            'status'       => 'in:posted,draft',
            'created_by'   => 'nullable|integer',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['ref_no'] = 'sometimes|string|max:20|unique:journals,ref_no,' . $this->route('journal')->id;
        } elseif ($this->isMethod('POST')) {
            $rules['lines']              = 'required|array';
            $rules['lines.*.account_id'] = 'required|integer|exists:chart_of_accounts,id';
            $rules['lines.*.debit']      = 'required|numeric|min:0';
            $rules['lines.*.credit']     = 'required|numeric|min:0';
        }

        return $rules;
    }
}
