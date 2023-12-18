<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransfusionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                'guid' => $this->guid,
                'date' => $this->date,
                'time' => $this->time,
                'hospital_guid' => $this->hospital,
                'donor_guid' => $this->donor,
                'type' => $this->type,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
        ];
    }
}
