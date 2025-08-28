<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'invoice'     => new InvoiceResource($this->whenLoaded('invoice')),
            'payment_ref' => $this->payment_ref,
            'paid_at'     => $this->paid_at->format('Y-m-d'),
            'created_at'  => $this->created_at->format('Y-m-d'),
            'amount_paid' => number_format($this->amount_paid, 2, '.', ''),
            'method'      => $this->method,
        ];
    }
}
