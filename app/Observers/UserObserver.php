<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewItem;

class UserObserver
{
    public function created(Contact $contact)
    {
        $author = User::find(1);
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewItem($contact,$author));
        }
    }
}
