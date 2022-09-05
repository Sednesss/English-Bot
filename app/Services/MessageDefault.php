<?php

namespace App\Services;

use App\Models\User;

class MessageDefault
{
    public function defineMessage()
    {
        return [
            'message' => $this->getMessage(),
            'keyboard' => [],
        ];
    }

    private function getMessage()
    {
        $administrators = User::role('administrator')->pluck('tg_username');

        $context = [
            'administrators' => $administrators,
        ];
        return (string)view('Telegram/responses/UserNotFound', $context);
    }
}
