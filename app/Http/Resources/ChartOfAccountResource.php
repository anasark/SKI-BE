<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChartOfAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'code'           => $this->code,
            'name'           => $this->name,
            'normal_balance' => $this->normal_balance,
            'is_active'      => (bool) $this->is_active,
            'created_at'     => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
