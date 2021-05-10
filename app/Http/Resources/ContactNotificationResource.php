<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'me' => [
                'id' => $this->mee->id,
                'name' => $this->mee->name,
                'username' => $this->mee->username,
                'terakhir_dilihat' => $this->mee->updated_at,
            ],
            'friend' => [
                'id' => $this->friendd->id,
                'name' =>  $this->friendd->name,
                'username' =>  $this->friendd->username,
                'terakhir_dilihat' =>  $this->friendd->updated_at
            ],
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
