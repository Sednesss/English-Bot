<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Helpers\MessagesTemplates;

class MessageTeacher implements RoleMessageInterface
{
    private string $incoming_message;
    private MessagesTemplates $messages_templates;
    private array $buttons = [
        'Информация об аккаунте',
        'Информация о группе',
        'Редактировать расписание',
        'Редактировать учебное пособие',
        'Отправить домашнее задание',
        'Отправить сопровождающий материал',
        'Включить уведомления'
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

    function getMessage(): string
    {
        if (in_array($this->incoming_message, $this->buttons)) {
            return $this->messages_templates->GetResponseMessage($this->incoming_message);
        } else {
            return '';
        }
    }

    function getKeyboard(): array
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
                [
                    [
                        'text' => $this->buttons[2],
                    ],
                    [
                        'text' => $this->buttons[3],
                    ],
                ],
                [
                    [
                        'text' => $this->buttons[4],
                    ],
                    [
                        'text' => $this->buttons[5],
                    ],
                ],
                [
                    [
                        'text' => $this->buttons[6],
                    ],
                ],
            ]
        ];
    }
}
