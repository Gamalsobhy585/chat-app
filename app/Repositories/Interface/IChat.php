<?php

namespace App\Repositories\Interface;

interface IChat
{

    public function getChat($userId);
    public function getAllChats();

    public function sendMessage($data);


   


    


}
