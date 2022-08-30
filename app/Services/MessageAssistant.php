<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Models\User;

class MessageAssistant implements RoleMessageInterface
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
        $user = User::where('tg_user_id', $this->tg_user_id)->first();

        $context = [
            'user' => $user,
        ];
        return (string)view('Telegram/responses/Assistant/AssistantMessage', $context);
    }

    function getKeyboard()
    {
        return [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'test 1',
                        'callback_data' => '1'
                    ],
                    [
                        'text' => 'test 2',
                        'callback_data' => '2'
                    ],
                ],
                [
                    [
                        'text' => 'test 3',
                        'callback_data' => '3'
                    ],
                ]
            ]
        ];
    }
}

