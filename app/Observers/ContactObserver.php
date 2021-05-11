<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\ContactNotification;

class ContactObserver
{
    public function created(Contact $contact)
    {
        $userFriend = $contact->friendd()->first();
        $userFriend->notify(new ContactNotification($contact));
        
        $userMe = $contact->mee()->first();
        $userMe->notify(new ContactNotification($contact));
    }

    public function updated(Contact $contact)
    {
        if($contact->status === 'ditolak'){
            $userFriend = $contact->friendd()->first();
            $userFriend->notify(new ContactNotification($contact));
            
            $userMe = $contact->mee()->first();
            $userMe->notify(new ContactNotification($contact));
        }else if($contact->status === 'diterima'){
            $userFriend = $contact->friendd()->first();
            $userFriend->notify(new ContactNotification($contact));
            
            $userMe = $contact->mee()->first();
            $userMe->notify(new ContactNotification($contact));
        }else{
            $userFriend = $contact->friendd()->first();
            $userFriend->notify(new ContactNotification($contact));
            
            $userMe = $contact->mee()->first();
            $userMe->notify(new ContactNotification($contact));
        }
    }
}
