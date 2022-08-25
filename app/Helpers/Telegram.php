<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram
{
    private string $url_telegram;
    private string $token;
    private Http $http;

    public function __construct(Http $http)
    {
        $this->url_telegram = 'https://api.telegram.org/bot';
        $this->token = config('telegram.bot.token');
        $this->http = $http;
    }

    public function sendMessage($chat_id, $message)
    {
        return $this->http::post($this->url_telegram . $this->token . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html'
            ]);
    }
}
