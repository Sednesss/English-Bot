<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\Telegram;
use Illuminate\Support\Facades\Http;

class MessageAdministrator implements RoleMessageInterface
{
    function getMessage($chat_id, $message)
    {
        $telegram = New Telegram(New Http());
        $telegram->sendMessage($chat_id, 'You admin' . $message);
    }
}
