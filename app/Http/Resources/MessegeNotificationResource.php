<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessegeNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $message = $this['message'];
        return [
            'id' => $message->id,
            'pengirim' => $message->pengirim,
            'penerima' => $message->penerima,
            'pesan' => $message->pesan,
            'read_at' => $message->read_at ? Carbon::parse($message->read_at)->isoFormat('DD/MM/YYYY HH:mm') : null,
            'created_at' => Carbon::parse($message->created_at)->isoFormat('DD/MM/YYYY HH:mm'),
            'timestamp' => Carbon::parse($message->created_at)->timestamp,
            'time' => Carbon::parse($message->created_at)->isoFormat('HH.mm'),
            'status' => $this['status']
        ];
    }
}
