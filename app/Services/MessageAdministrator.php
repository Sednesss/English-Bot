<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\MessagesTemplates;

class MessageAdministrator implements RoleMessageInterface
{
    private string $incoming_message;
    private MessagesTemplates $messages_templates;
    private array $buttons = [
        'Информация об аккаунте',
        'Оповестить всех',
    ];


    public function __construct($messages_templates, $incoming_message)
    {
        $this->incoming_message = $incoming_message;
        $this->messages_templates = $messages_templates;
    }

    public function defineMessage(): array
    {
        return [
            'message' => $this->getMessage(),
            'keyboard' => $this->getKeyboard(),
        ];
    }

    private function getMessage(): string
    {
        if (in_array($this->incoming_message, $this->buttons)) {
            return $this->messages_templates->GetResponseMessage($this->incoming_message);
        } else {
            return '';
        }
    }

    private function getKeyboard(): array
    {
        return [
            'keyboard' => [
                [
                    [
                        'text' => $this->buttons[0],
                    ],
                ],
                [
                    [
                        'text' => $this->buttons[1],
                    ],
                ],
            ]
        ];
    }
}
