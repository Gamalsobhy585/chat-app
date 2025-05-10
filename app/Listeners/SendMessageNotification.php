<?php
namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageNotification implements ShouldQueue
{

    public function __construct()
    {
       
    }


    public function handle(MessageSent $event)
    {
       
    }
}