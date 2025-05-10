<?php
namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Services\ChatService;
use App\Models\User;
use App\Notifications\MessageReceived;
use App\Http\Requests\SendMessageRequest;

class ChatController extends Controller
{
    use ResponseTrait;
    
    private ChatService $chatService;
    
    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }
    
    public function getChatMessages($userId)
    {
        try {
            $messages = $this->chatService->getChat($userId);
            return $this->returnData('Messages retrieved successfully', 200, $messages);
        } catch (\Exception $e) {
            return $this->returnErrorNotAbort($e->getMessage(), 500);
        }
    }
    
  public function sendMessage(SendMessageRequest $request, $userId)
    {
        try {
            $message = $this->chatService->sendMessage($userId, $request->message);
            
            $receiver = User::find($userId);
            if ($receiver) {
                $receiver->notify(new MessageReceived($message));
            }
            
            return $this->returnData('Message sent successfully', 200, $message);
        } catch (\Exception $e) {
            return $this->returnErrorNotAbort($e->getMessage(), 500);
        }
    }
    
    public function getAllChats()
    {
        try {
            $chats = $this->chatService->getAllChats();
            return $this->returnData('Chats retrieved successfully', 200, $chats);
        } catch (\Exception $e) {
            return $this->returnErrorNotAbort($e->getMessage(), 500);
        }
    }
}