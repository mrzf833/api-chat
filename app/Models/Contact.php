<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function mee()
    {
        return $this->belongsTo(User::class, 'me', 'id');
    }

    public function friendd()
    {
        return $this->belongsTo(User::class, 'friend', 'id');
    }
}
