<?php

namespace App\Contracts\Telegram;

interface RoleMessageInterface
{
    function getMessage($chat_id, $message);
}
