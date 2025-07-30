<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            'date' => [
                'default' => $this->date,
                'humanReadable' => date_format(date_create($this->date), 'jS F, Y')
            ],
            "booked_by" => new CustomerResource($this->customer),
            "service" => new ServiceResource($this->service),
            "status" => $this->status
        ];
    }
}
