<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactHelper extends Controller
{
    public static function cek_diterima($friendId)
    {
        $pengecekan_kontak = Contact::where(function($q){
            $q->where('status', 'diterima');
        })
        ->where(function($q) use ($friendId){
            $q->where(function($qu) use ($friendId){
                $qu->where('me', auth()->id())
                ->where('friend', $friendId);
            })
            ->orWhere(function($qu) use ($friendId){
                $qu->where('me', $friendId)
                ->where('friend', auth()->id());
            });
        });
        
        if($pengecekan_kontak->count() > 0){
            return true;
        }

        return false;
    }

    public static function cek_sedang_menunggu_konfirmasi($friendId)
    {
        $pengecekan_kontak = Contact::where(function($q){
            $q->where('status', 'proses');
        })
        ->where(function($qu) use ($friendId){
            $qu->where('me', auth()->id())
            ->where('friend', $friendId);
        });

        if($pengecekan_kontak->count() > 0){
            return true;
        }

        return false;
    }

    public static function cek_konfirmasi($friendId)
    {
        $pengecekan_kontak = Contact::where(function($q){
            $q->where('status', 'proses');
        })
        ->where(function($qu) use ($friendId){
            $qu->where('me', $friendId)
            ->where('friend', auth()->id());
        });

        if($pengecekan_kontak->count() > 0){
            return true;
        }

        return false;
    }
}
