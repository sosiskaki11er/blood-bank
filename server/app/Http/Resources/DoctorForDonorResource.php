<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorForDonorResource extends JsonResource
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
              'name' => $this->name,
              'surname' => $this->surname,
              'phone' => $this->phone,
              'email' => $this->email,
              'description' => $this->description,
              'hospital' => $this->hospital_guid,
        ];
    }
}
