<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Models\User;

class MessageStudent implements RoleMessageInterface
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
            'message' => $this->getMessage($this->tg_user_id),
            'keyboard' => $this->getKeyboard(),
        ];
    }

    function getMessage($chat_id)
    {
        $view_template = 'Telegram/responses/Student/';
        $context = [];

        switch ($this->incoming_message) {
            case 'Расписание':
                $view_template .= 'PushGetTimetableMessage';
                break;
            case 'Домашнее задание':
                $view_template .= 'PushGetHomeworkMessage';
                break;
            case 'Сопровождающий материал':
                $view_template .= 'PushGetMaterialMessage';
                break;
            case 'Учебное пособие':
                $view_template .= 'PushGetTutorialMessage';
                break;
            case 'Включить уведомления':
                $view_template .= 'PushOnOffNotificationsMessage';
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
                        'text' => 'Расписание',
                    ],
                ],
                [
                    [
                        'text' => 'Домашнее задание',
                    ],
                    [
                        'text' => 'Сопровождающий материал',
                    ],
                ],
                [
                    [
                        'text' => 'Учебное пособие',
                    ],
                ],
                [
                    [
                        'text' => 'Включить уведомления',
                    ],
                ],
            ]
        ];
    }
}
