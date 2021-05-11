<?php

namespace App\Http\Resources;

use App\Http\Controllers\UserController;
use App\Models\Message;
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
        $pesan_terakhir = null;
        $as_pesan = null;
        if($this->mee->id !== $id){
            $pesan_terakhir = Message::where(function($qu){
                $user_id = $this->mee->id;
                $qu->where(function($q) use ($user_id){
                    $q->where('pengirim', auth()->id())
                    ->where('penerima', $user_id);
                })
                ->orWhere(function($q) use ($user_id){
                    $q->where('pengirim', $user_id)
                    ->where('penerima', auth()->id());
                });
            })
            ->orderBy('created_at', 'desc')
            ->first() ?? null;
        }else{
            $pesan_terakhir = Message::where(function($qu){
                $user_id = $this->friendd->id;
                $qu->where(function($q) use ($user_id){
                    $q->where('pengirim', auth()->id())
                    ->where('penerima', $user_id);
                })
                ->orWhere(function($q) use ($user_id){
                    $q->where('pengirim', $user_id)
                    ->where('penerima', auth()->id());
                });
            })
            ->orderBy('created_at', 'desc')
            ->first() ?? null;
        }
        return [
            "id" => $this->id,
            'friend' => [
                'id' => $this->mee->id !== $id ? $this->mee->id : $this->friendd->id,
                'name' => $this->mee->id !== $id ? $this->mee->name : $this->friendd->name,
                'username' => $this->mee->id !== $id ? $this->mee->username : $this->friendd->username,
                'terakhir_dilihat' => $this->mee->id !== $id ? UserController::userOnlineStatusFind($this->mee->id) : UserController::userOnlineStatusFind($this->friendd->id),
                'pesan_terakhir' => $pesan_terakhir ? $pesan_terakhir['pesan'] : null,
                'as_pesan' => $pesan_terakhir ? ($pesan_terakhir['pengirim'] == $id ? 'pengirim' : 'penerima') : 'penerima',
                'read_at' => $pesan_terakhir ? $pesan_terakhir['read_at'] : null
            ],
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}