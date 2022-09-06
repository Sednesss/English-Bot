<?php

namespace App\Contracts\Telegram;

use App\Helpers\MessagesTemplates;

interface RoleMessageInterface
{
    public function __construct(MessagesTemplates $messages_templates);

    public function getCommands();
    public function isHandlerToIncomingMessage($incoming_message);
    public function getMessage($incoming_message);
}
