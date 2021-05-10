<?php

namespace App\Observers;

use App\Models\Message;
use App\Notifications\MessageNotification;

class MessageObserver
{
    public $afterCommit = true;
    /**
     * Handle the Message "created" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        $userFriend = $message->penerima()->first();
        $userFriend->notify(new MessageNotification($message, 'created'));
        
        $userMe = $message->pengirim()->first();
        $userMe->notify(new MessageNotification($message, 'created'));
    }

    /**
     * Handle the Message "updated" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        $userFriend = $message->penerima()->first();
        $userFriend->notify(new MessageNotification($message, 'updated'));
        
        $userMe = $message->pengirim()->first();
        $userMe->notify(new MessageNotification($message, 'updated'));
    }

    /**
     * Handle the Message "deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
