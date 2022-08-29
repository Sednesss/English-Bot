<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\Telegram;
use Illuminate\Support\Facades\Http;

class MessageAdministrator implements RoleMessageInterface
{
    public function defineMessage($chat_id, $message){
        return [
            'message' => $this->getMessage(),
            'keyboard' => $this->getKeyboard(),
        ];
    }

    function getMessage()
    {
//        $telegram = New Telegram(New Http());
//        $telegram->sendMessage($chat_id, 'You admin' . $message);
//        $telegram = app(Telegram::class)->sendMessage($chat_id, 'You admin' . ' ' . $message);
    }

    function getKeyboard()
    {
    }
}
