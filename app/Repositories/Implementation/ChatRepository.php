<?php
namespace App\Repositories\Implementation;
use App\Models\Message;
use App\Repositories\Interface\IChat;
use Illuminate\Support\Facades\Auth;

class ChatRepository implements IChat
{
    public function getChat($userId)
    {
        $currentUser = Auth::id();
        return Message::where(function($query) use ($userId, $currentUser) {
            $query->where('sender', $currentUser)
                  ->where('receiver', $userId);
        })->orWhere(function($query) use ($userId, $currentUser) {
            $query->where('sender', $userId)
                  ->where('receiver', $currentUser);
        })->orderBy('created_at', 'asc')->get();
    }
    
    public function sendMessage($data)
    {
        return Message::create($data);
    }
    
    public function getAllChats()
    {
        $currentUser = Auth::id();
        
        $chatPartners = Message::where('sender', $currentUser)
            ->orWhere('receiver', $currentUser)
            ->select('sender', 'receiver')
            ->get()
            ->map(function($message) use ($currentUser) {
                return $message->sender == $currentUser ? $message->receiver : $message->sender;
            })->unique()->values();
            
        $chats = [];
        foreach($chatPartners as $partnerId) {
            $latestMessage = Message::where(function($query) use ($partnerId, $currentUser) {
                $query->where('sender', $currentUser)
                      ->where('receiver', $partnerId);
            })->orWhere(function($query) use ($partnerId, $currentUser) {
                $query->where('sender', $partnerId)
                      ->where('receiver', $currentUser);
            })->latest()->first();
            
            if ($latestMessage) {
                $chats[] = [
                    'partner_id' => $partnerId,
                    'latest_message' => $latestMessage
                ];
            }
        }
        
        return $chats;
    }
}