<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewItem;

class UserObserver
{
    public function created(Contact $contact)
    {
        $userFriend = $contact->friendd()->first();
        $userFriend->notify(new NewItem($contact));
        
        $userMe = $contact->mee()->first();
        $userMe->notify(new NewItem($contact));
    }

    public function updated(Contact $contact)
    {
        if($contact->status === 'ditolak'){
            $userFriend = $contact->friendd()->first();
            $userFriend->notify(new NewItem($contact));
            
            $userMe = $contact->mee()->first();
            $userMe->notify(new NewItem($contact));
        }else if($contact->status === 'diterima'){
            $userFriend = $contact->friendd()->first();
            $userFriend->notify(new NewItem($contact));
            
            $userMe = $contact->mee()->first();
            $userMe->notify(new NewItem($contact));
        }else{
            $userFriend = $contact->friendd()->first();
            $userFriend->notify(new NewItem($contact));
            
            $userMe = $contact->mee()->first();
            $userMe->notify(new NewItem($contact));
        }
    }
}
