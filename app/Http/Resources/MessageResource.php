<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'id' => $this->id,
            'pengirim' => $this->pengirim,
            'penerima' => $this->penerima,
            'pesan' => $this->pesan,
            'read_at' => $this->read_at ? Carbon::parse($this->read_at)->isoFormat('DD/MM/YYYY HH:mm') : null,
            'created_at' => Carbon::parse($this->created_at)->isoFormat('DD/MM/YYYY HH:mm'),
            'timestamp' => Carbon::parse($this->created_at)->timestamp,
            'time' => Carbon::parse($this->created_at)->isoFormat('HH.mm'),
        ];
    }
}
