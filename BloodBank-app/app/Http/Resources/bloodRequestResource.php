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
            'bloodype_id' => $this->bloodType_id,
            // 'bloodtype_name' => $this->bloodType->name,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'sent_by' => $this->user->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        // return parent::toArray($request);
    }

    /**
     * Use the user_id to get the username of the user that sent the request and the bloodType id to get the bloodType name
     */
    public function with($request)
    {
        return [
            'user_id' => $this->user_id,
            'username' => $this->user->name,
            'bloodType_id' => $this->bloodType_id,
            'bloodType_name' => $this->bloodType->name,
        ];
    }

    /**
     * If status is 0, change it to "pending" and if status is 1, change it to "approved"
     */
    //  public function withStatus($request)
    //  {
    //      return [
    //          'status' => $this->status,
    //          'status' => $this->status == 0 ? 'pending' : 'approved',
    //      ];
    //  }
     
}
