<?php

namespace App\Notifications;

use App\Http\Resources\MessageResource;
use App\Http\Resources\MessegeNotificationResource;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $status;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message, $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => new MessegeNotificationResource(['message' => $this->message, 'status' => $this->status])
        ];
    }
}
