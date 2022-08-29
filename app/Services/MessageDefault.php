<?php

namespace App\Services;

use App\Contracts\Telegram\RoleMessageInterface;
use App\Models\User;

class MessageDefault implements RoleMessageInterface
{
    public function defineMessage($chat_id, $message){
        return [
            'message' => $this->getMessage(),
            'keyboard' => $this->getKeyboard(),
        ];
    }
    private function getMessage()
    {
        $administrators = $users = User::role('administrator')->get();
        return view('Telegram/responses/DefaultMessage');
    }

    private function getKeyboard()
    {
        $buttons = [
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
        return $buttons;
    }
}
