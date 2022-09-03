<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Models\User;

class MessageTeacher implements RoleMessageInterface
{
    private int $tg_user_id;
    private string $incoming_message;


    public function __construct($tg_user_id, $incoming_message)
    {
        $this->tg_user_id = $tg_user_id;
        $this->incoming_message = $incoming_message;
    }

    public function defineMessage()
    {
        return [
            'message' => $this->getMessage(),
            'keyboard' => $this->getKeyboard(),
        ];
    }

    function getMessage()
    {
        $view_template = 'Telegram/responses/Teacher/';
        $context = [];

        switch ($this->incoming_message) {
            case 'Редактировать расписание':
                $view_template .= 'PushEditTimetableMessage';
                break;
            default:
                $view_template .= 'DefaultMessage';

                $user = User::where('tg_user_id', $this->tg_user_id)->first();
                $context = [
                    'user' => $user,
                ];
                break;
        }
        return (string)view($view_template, $context);
    }

    function getKeyboard()
    {
        return [
            'keyboard' => [
                [
                    [
                        'text' => 'Редактировать расписание',
                    ],
                    [
                        'text' => 'Редактировать учебное пособие',
                    ],
                ],
                [
                    [
                        'text' => 'Отправить домашнее задание',
                    ],
                    [
                        'text' => 'Отправить сопровождающий материал',
                    ],
                ],
                [
                    [
                        'text' => 'Включить уведомления',
                    ],
                ]
            ]
        ];
    }
}
