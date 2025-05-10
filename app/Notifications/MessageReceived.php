<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class MessageReceived extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

  
    public function __construct(Message $message)
    {
        $this->message = $message;
    }


    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

 
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message_id' => $this->message->id,
            'sender_id' => $this->message->sender,
            'message' => $this->message->message,
            'created_at' => $this->message->created_at->format('Y-m-d H:i:s'),
        ]);
    }


    public function toArray($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'sender_id' => $this->message->sender,
            'message' => $this->message->message,
        ];
    }
}