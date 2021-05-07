<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\ContactHelper;
use Exception;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactKonfirmasiResource;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('friendd', 'mee')
        ->where(function($q){
            $q->where('me', auth()->id())
            ->orWhere('friend', auth()->id());
        })
        ->where('status', 'diterima')
        ->get();

        return ContactResource::collection($contacts);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'friend' => 'required|exists:users,username'
        ]);

        $friend = User::where('username', $request->friend)->first();

        if(auth()->id() === $friend->id){
            abort(422, 'maaf friend tidak sesuai');
        }

        $cek_sudah_ada = ContactHelper::cek_diterima($friend->id);
        if($cek_sudah_ada){
            abort(422, 'Friend sudah ada');
        }
        $cek_sedang_menunggu_konfirmasi = ContactHelper::cek_sedang_menunggu_konfirmasi($friend->id);
        if($cek_sedang_menunggu_konfirmasi){
            abort(422, 'Sedang menunggu konfirmasi');
        }
        $cek_konfirmasi = ContactHelper::cek_konfirmasi($friend->id);
        if($cek_konfirmasi){
            abort(422, 'Silahkan cek di menu konfirmasi');
        }

        DB::beginTransaction();
        try{
            Contact::updateOrCreate(
                [
                'me' => auth()->id(),
                'friend' => $friend->id
                ],
                [
                    'status' => 'proses'
                ]
            );
            DB::commit();
            return response()->json([
                'message' => 'contact pertemanan berhasil di kirim'
            ]); 
        }catch(Exception $e){
            DB::rollBack();
            return abort(500, $e->getMessage());
        }
    }

    public function proses()
    {
        $contacts = Contact::with('friendd', 'mee')
        ->where(function($q){
            $q->where('me', auth()->id());
            // ->orWhere('friend', auth()->id());
        })
        ->where('status', 'proses')
        ->get();

        return ContactResource::collection($contacts);
    }

    public function tolak()
    {
        $contacts = Contact::with('friendd', 'mee')
        ->where(function($q){
            $q->where('me', auth()->id())
            ->orWhere('friend', auth()->id());
        })
        ->where('status', 'ditolak')
        ->get();

        return ContactResource::collection($contacts);
    }

    public function konfirmasi()
    {
        $contacts = Contact::with('friendd')
        ->where('friend', auth()->id())
        ->where('status', 'proses')
        ->get();
        return ContactKonfirmasiResource::collection($contacts);
    }

    public function proses_konfirmasi(Request $request,$friend)
    {
        $this->validate($request,[
            'status' => 'required|in:ditolak,diterima'
        ]);

        $contact = Contact::where('status','proses')
        ->where('me', $friend)
        ->where('friend', auth()->id())
        ->firstOrFail();

        DB::beginTransaction();
        try{
            $contact->update([
                'status' => $request->status
            ]);

            if($request->status === 'diterima'){
                Contact::where(function($q)use($friend){
                    $q->where(function($qu)use($friend){
                        $qu->where('me', auth()->id())
                        ->where('friend', $friend);
                    })
                    ->orWhere(function($qu)use($friend){
                        $qu->where('friend', auth()->id())
                        ->where('me', $friend);
                    });
                })
                ->where('status', 'ditolak')
                ->delete();
            }
            DB::commit();
            return response()->json(['message' => 'contact berhasil di ' . $request->status]);
        }catch(Exception $e){
            DB::rollBack();
            return abort(500, $e->getMessage());
        }
    }
}
