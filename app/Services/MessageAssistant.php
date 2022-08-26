<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\Telegram;
use Illuminate\Support\Facades\Http;

class MessageAssistant implements RoleMessageInterface
{
    function getMessage($chat_id, $message)
    {
        $telegram = New Telegram(New Http());
        $result = $telegram->sendMessage($chat_id, 'You assistant' . $message);
    }
}

