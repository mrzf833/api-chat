<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\CheckUserHelper;
use App\Http\Resources\MessageResource;
use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function user_message($user_id)
    {
        $check_contact = CheckUserHelper::check_user_contact($user_id);
        if($check_contact['status']){
            return response()->json(['message' => 'anda belum berteman'], 422);
        }
        $user = User::find($user_id);
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'terakhir_dilihat' => UserController::userOnlineStatusFind($user_id)
        ]);
    }

    public function message_data(Request $request,$user_id)
    {
        $check_contact = CheckUserHelper::check_user_contact($user_id);
        if($check_contact['status']){
            return response()->json(['message' => 'anda belum berteman'], 422);
        }

        $this->validate($request,[
            'skip' => 'nullable|numeric'
        ]);
        $this->read_all_message($user_id);
        $skip = $request->skip ?? 0;
        $messages = Message::where(function($qu) use ($user_id){
            $qu->where(function($q) use ($user_id){
                $q->where('pengirim', auth()->id())
                ->where('penerima', $user_id);
            })
            ->orWhere(function($q) use ($user_id){
                $q->where('pengirim', $user_id)
                ->where('penerima', auth()->id());
            });
        })->orderBy('created_at', 'desc')->skip($skip)->take(10)->get();
        return MessageResource::collection($messages);
        return 'ini adalah message';
    }

    public function read_all_message($user_id)
    {
        $check_contact = CheckUserHelper::check_user_contact($user_id);
        if($check_contact['status']){
            return response()->json(['message' => 'anda belum berteman'], 422);
        }

        $messages = Message::whereNull('read_at')
        ->where(function($q)use($user_id){
            return $q->where('pengirim', $user_id)
            ->where('penerima', auth()->id());
        });

        if($messages->count() > 0){
            foreach($messages->get() as $message){
                $message->update([
                    'read_at' => Carbon::now()
                ]);
            }
        }

        return response()->json(['message' => 'message berhasil di read semua']);
    }

    public function store(Request $request, $user_id)
    {
        $check_contact = CheckUserHelper::check_user_contact($user_id);
        if($check_contact['status']){
            return response()->json(['message' => 'anda belum berteman'], 422);
        }

        $this->validate($request,[
            'pesan' => 'required'
        ]);

        $message = Message::create([
            'pengirim' => auth()->id(),
            'penerima' => $user_id,
            'pesan' => $request->pesan
        ]);

        return response()->json(['message' => $message]);
    }
}
