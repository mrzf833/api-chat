<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userOnlineStatus()
    {
        $users = DB::table('users')->get();
    
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
                echo "User " . $user->name . " is online.";
            else
                echo "User " . $user->name . " is offline.";
        }
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
}
