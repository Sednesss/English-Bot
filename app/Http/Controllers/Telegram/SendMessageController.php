<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Requests\Telegram\SendMessageRequest;

class SendMessageController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $validated = $request->validated();

        $chat_id = $validated['chat_id'];
        $text = $validated['text'];

        $result = $this->telegram->sendMessage($chat_id, $text);
        dd(json_decode($result->body()));
    }
}
