<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleDonorResource extends JsonResource
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
            'address' => $this->address,
            'birth' => $this->birth,
            'blood_type' => $this->blood_type,
            'blood_rh' => $this->blood_rh,
            'blood_disease' => $this->blood_disease,
            'doctor' => new DoctorForDonorResource($this->doctor),
            'doctor_comment' => $this->doctor_comment,
        ];
    }
}
