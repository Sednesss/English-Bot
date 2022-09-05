<?php

namespace App\Contracts\Telegram;

use App\Helpers\MessagesTemplates;

interface RoleMessageInterface
{
    public function __construct(MessagesTemplates $messages_templates, string $incoming_message);

    public function defineMessage();
}
