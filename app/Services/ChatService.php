<?php
namespace App\Services;

use App\Events\MessageSent;
use App\Repositories\Interface\IChat;
use App\Services\Interface\IChatService;
use Illuminate\Support\Facades\Auth;

class ChatService implements IChatService
{
    private IChat $chatRepo;
    
    public function __construct(IChat $chat)
    {
        $this->chatRepo = $chat;
    }
    
    public function getChat($userId)
    {
        return $this->chatRepo->getChat($userId);
    }
    
   public function sendMessage($userId, $message)
    {
        $data = [
            'sender' => Auth::id(),
            'receiver' => $userId,
            'message' => $message
        ];
        
        $message = $this->chatRepo->sendMessage($data);
        
        event(new MessageSent($message));
        
        return $message;
    }
    
    public function getAllChats()
    {
        return $this->chatRepo->getAllChats();
    }
}