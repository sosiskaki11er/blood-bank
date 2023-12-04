<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SinglePatientResource extends JsonResource
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
                'address' => $this->address,
                'email' => $this->email,
                'birth' => $this->birth,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'doctors' => $this->doctors,
                'roles' => $this->roles,
        ];
    }
}
