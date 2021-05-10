<?php

namespace App\Http\Controllers\Helper;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckUserHelper extends Controller
{
    public static function check_user_contact($user_id)
    {
        $contact = Contact::where('status', 'diterima')
        ->where(function($qu) use ($user_id){
            $qu->where(function($q) use ($user_id){
                $q->where('me', auth()->id())
                ->where('friend', $user_id);
            })
            ->orWhere(function($q) use ($user_id){
                $q->where('me', $user_id)
                ->where('friend', auth()->id());
            });
        })->first();
        if(!isset($contact)){
            return [
                'status' => true,
                
            ];
        }
        return [
            'status' => false,
            'user' => $contact
        ];
    }
}
