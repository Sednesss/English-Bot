<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Models\User;

class MessageDefault implements RoleMessageInterface
{
    private int $tg_user_id;
    private string $incoming_message;

    public function __construct($tg_user_id, $incoming_message)
    {
        $this->tg_user_id = $tg_user_id;
        $this->incoming_message = $incoming_message;
    }

    public function defineMessage(){
        return [
            'message' => $this->getMessage(),
            'keyboard' => $this->getKeyboard(),
        ];
    }
    private function getMessage()
    {
        $administrators = $users = User::role('administrator')->pluck('tg_username');

        $context = [
            'administrators' => $administrators,
        ];
        return (string)view('Telegram/responses/Default/DefaultMessage', $context);
    }

    private function getKeyboard()
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
