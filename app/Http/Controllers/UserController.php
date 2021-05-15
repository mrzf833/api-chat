<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userOnlineStatus()
    {
        $contacts = Contact::where('status', 'diterima')
        ->where(function($q){
            $q->where('me', auth()->id())
            ->orWhere('friend', auth()->id());
        })
        ->get();

        $users = [];
        foreach ($contacts as $contact) {
            $user_id = $contact->me == auth()->id() ? $contact->friend : $contact->me;
            if (Cache::has('user-is-online-' . $user_id)){
                array_push($users,['id' => $user_id, 'status' => 'online']);
            }else{
                $user = User::find($user_id);
                array_push($users, ['id' => $user_id, 'status' => Carbon::parse($user->updated_at)->isoFormat('DD/MM/YYYY HH:mm')]);
            }
        }

        return response()->json($users);
    }

    public static function userOnlineStatusFind($user_id)
    {
        $user = User::find($user_id);
        $terakhir_dilihat = null;
    
        if (Cache::has('user-is-online-' . $user->id)){
            $terakhir_dilihat = 'online'; 
        }else{
            $terakhir_dilihat = Carbon::parse($user->updated_at)->isoFormat('DD/MM/YYYY HH:mm');
        }

        return $terakhir_dilihat;
    }

    public function closeWindow()
    {
        auth()->user()->update([
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['message' => 'user berhasil di update']);
    }
}
