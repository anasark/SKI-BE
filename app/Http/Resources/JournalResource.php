<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'ref_no'       => $this->ref_no,
            'posting_date' => $this->posting_date->format('Y-m-d'),
            'memo'         => $this->memo,
            'status'       => $this->status,
            'lines'        => JournalLineResource::collection($this->whenLoaded('lines')),
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
