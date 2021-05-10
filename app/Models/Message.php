<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim','id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima', 'id');
    }
}
