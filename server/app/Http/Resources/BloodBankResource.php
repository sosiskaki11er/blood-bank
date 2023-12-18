<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodBankResource extends JsonResource
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
                'hospital_id' => $this->hospital_guid,
                'blood_type' => $this->blood_type,
                'amount' => $this->amount
        ];
    }
}
