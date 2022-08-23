<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram
{
    private string $url_telegram;
    private string $token;

    public function __construct()
    {
        $this->url_telegram = 'https://api.telegram.org/bot';
        $this->token = config('telegram.token');
    }

    public function sendMessage($chat_id, $message)
    {
        Http::post($this->url_telegram . $this->token . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html'
            ]);
    }
}
