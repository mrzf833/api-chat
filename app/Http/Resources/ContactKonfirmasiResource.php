<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactKonfirmasiResource extends JsonResource
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
            'friend' => [
                'id' => $this->mee->id,
                'name' => $this->mee->name,
                'username' => $this->mee->username,
                'terakhir_dilihat' => $this->mee->updated_at,
            ],
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];;
    }
}
