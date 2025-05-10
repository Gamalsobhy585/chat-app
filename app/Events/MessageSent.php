<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->message->receiver);
    }
    
  
    public function broadcastAs()
    {
        return 'new.message';
    }
    

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'sender' => $this->message->sender,
            'receiver' => $this->message->receiver,
            'message' => $this->message->message,
            'created_at' => $this->message->created_at,
        ];
    }
}