<?php

namespace App\Contracts\Telegram;

interface RoleMessageInterface
{
    function defineMessage($chat_id, $message);
}
