<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class bloodRequestResource extends JsonResource
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
            'id' => $this->id,
            'ref_code' => $this->ref_code,
            'facility_id' => $this->facility_id,
            'blood_type_id' => $this->blood_type_id,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        // return parent::toArray($request);
    }
}
