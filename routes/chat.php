<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
Route::middleware('auth:sanctum')->group(function () 
{
    Route::prefix('chats')->group(function () 
    {
        Route::get('/{userId}', [ChatController::class, 'getChatMessages']);
        Route::post('/{userId}', [ChatController::class, 'sendMessage']);
        Route::get('/', [ChatController::class, 'getAllChats']);

    });
});

?>