<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\MessagesTemplates;

class MessageWithoutRole implements RoleMessageInterface
{
    private string $incoming_message;
    private MessagesTemplates $messages_templates;

    public function __construct(MessagesTemplates $messages_templates, string $incoming_message)
    {
        $this->incoming_message = $incoming_message;
        $this->messages_templates = $messages_templates;
    }

    public function defineMessage(): array
    {
        return [
            'message' => $this->getMessage(),
            'keyboard' => ['keyboard' => ''],
        ];
    }

    private function getMessage(): string
    {
        return $this->messages_templates->GetResponseMessage('Пользователь не найден');
    }
}
