<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'account' => new ChartOfAccountResource($this->whenLoaded('account')),
            'dept_id' => $this->dept_id,
            'debit'   => number_format($this->debit, 2, '.', ''),
            'credit'  => number_format($this->credit, 2, '.', ''),
        ];
    }
}
