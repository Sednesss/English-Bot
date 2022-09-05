<?php

namespace App\Contracts\Telegram;

use App\Models\User;

interface RoleMessageInterface
{
    public function __construct(User $user, string $incoming_message);

    public function defineMessage();
}
