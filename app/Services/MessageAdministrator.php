<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\MessagesTemplates;
use App\Models\User;

class MessageAdministrator implements RoleMessageInterface
{
    private string $incoming_message;
    private MessagesTemplates $messages_templates;


    public function __construct($user, $incoming_message)
    {
        $this->incoming_message = $incoming_message;
        $this->messages_templates = new MessagesTemplates($user, $incoming_message);
    }

    public function defineMessage()
    {
        return [
            'message' => $this->getMessage(),
            'keyboard' => $this->getKeyboard(),
        ];
    }

    private function getMessage(): string
    {
        return match ($this->incoming_message) {
            'Оповестить всех' => $this->messages_templates->GetResponseMessage('Оповестить всех'),
            default => $this->messages_templates->GetResponseMessage('default'),
        };
    }

    private function getKeyboard()
    {
        return [
            'keyboard' => [
                [
                    [
                        'text' => 'Оповестить всех',
                    ],
                ],
            ]
        ];
    }
}
