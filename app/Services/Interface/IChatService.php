<?php

namespace App\Services\Interface;

interface IChatService
{
    public function getChat($userId);
    public function sendMessage($userId, $message);
    public function getAllChats();



}
