<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class facilityResource extends JsonResource
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
            // 'user_id' => $this->user_id,
            'admin' => $this->user->name,
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'city' => $this->city,
            'region' => $this->region,
            'gps' => $this->gps,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
        // return parent::toArray($request);
    }

    /**
     * Use the user_id to get the username of the user that owns the facility
     */
    public function with($request)
    {
        return [
            'user_id' => $this->user_id,
            'username' => $this->user->name,
        ];
    }
    
    
}
