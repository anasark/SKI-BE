<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'invoice_no'   => 'required|string|max:20|unique:invoices,invoice_no',
            'invoice_date' => 'required|date',
            'customer'     => 'required|string|max:120',
            'amount'       => 'required|numeric|min:0',
            'tax_amount'   => 'numeric|min:0',
            'status'       => 'in:open,partial,paid',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['invoice_no'] = 'sometimes|string|max:20|unique:invoices,invoice_no,' . $this->route('invoice')->id;
            $rules['customer']   = 'sometimes|string|max:120';
            $rules['amount']     = 'sometimes|numeric|min:0';
            $rules['tax_amount'] = 'sometimes|numeric|min:0';
            $rules['status']     = 'sometimes|in:open,partial,paid';
        }

        return $rules;
    }
}
