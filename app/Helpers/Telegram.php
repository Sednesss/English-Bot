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

    //Установка веб перехватчика для бота
    public function setWebhook($url): \Illuminate\Http\Client\Response
    {
        return $this->http::get($this->url_telegram . $this->token . '/setWebhook',
            [
                'url' => $url,
            ]);
    }

    //Отправка текстовых сообщений по telegram_id
    public function sendMessage($chat_id, $message, $buttons): \Illuminate\Http\Client\Response
    {
        return $this->http::post($this->url_telegram . $this->token . '/sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => $message,
                'parse_mode' => 'html',
                'reply_markup' => $buttons,
            ]);
    }
}
