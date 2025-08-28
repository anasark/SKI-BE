<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'invoice_id'  => 'required|exists:invoices,id',
            'payment_ref' => 'nullable|string|max:30|unique:payments,payment_ref',
            'paid_at'     => 'required|date',
            'amount_paid' => 'required|numeric|min:0',
            'method'      => 'nullable|string|max:50',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['payment_ref'] = 'nullable|string|max:30|unique:payments,payment_ref,' . $this->route('payment')->id;
        }

        return $rules;
    }
}
