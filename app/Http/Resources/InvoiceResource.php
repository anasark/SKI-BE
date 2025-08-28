<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'invoice_no' => $this->invoice_no,
            'date'       => $this->invoice_date->format('Y-m-d'),
            'customer'   => $this->customer,
            'amount'     => number_format($this->amount, 2, '.', ''),
            'tax'        => number_format($this->tax_amount, 2, '.', ''),
            'status'     => $this->status,
            'payments'   => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
