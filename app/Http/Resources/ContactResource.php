<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $id = auth()->id();
        return [
            "id" => $this->id,
            'friend' => [
                'id' => $this->mee->id !== $id ? $this->mee->id : $this->friendd->id,
                'name' => $this->mee->id !== $id ? $this->mee->name : $this->friendd->name,
                'username' => $this->mee->id !== $id ? $this->mee->username : $this->friendd->username,
                'terakhir_dilihat' => $this->mee->id !== $id ? $this->mee->updated_at : $this->friendd->updated_at
            ],
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
