<?php

namespace App\Contracts\Telegram;

interface RoleMessageInterface
{
    public function __construct(int $tg_user_id, string $incoming_message);

    public function defineMessage();
}
