<?php

namespace App\Services\Telegram;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\MessagesTemplates;

class BaseMessageRole implements RoleMessageInterface
{
    protected MessagesTemplates $messages_templates;
    protected array $commands = [];

    public function __construct($messages_templates)
    {
        $this->messages_templates = $messages_templates;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function isHandlerToIncomingMessage($incoming_message): bool
    {
        if (in_array($incoming_message, $this->commands)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMessage($incoming_message): string
    {
        return $this->messages_templates->GetResponseMessage($incoming_message);
    }
}
