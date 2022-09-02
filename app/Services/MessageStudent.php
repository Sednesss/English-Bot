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
        $user = User::where('tg_user_id', $chat_id)->first();

        $context = [
            'user' => $user,
        ];
        return (string)view('Telegram/responses/Student/StudentMessage', $context);
    }

    function getKeyboard()
    {
        return [
            'keyboard' => [
                [
                    [
                        'text' => 'Рассписание',
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
