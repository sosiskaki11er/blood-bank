<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodBanksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'guid' => $this->guid,
            'hospital_guid' => $this->hospital,
            'blood_type' => $this->blood_type,
            'amount' => $this->amount,
            'price' => $this->price,
        ];
    }
}
