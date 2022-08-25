<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;

class SendMessageController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendMessage(Request $request)
    {
        $result = $this->telegram->sendMessage(542017586, 'hello');
        dd(json_decode($result->body()));
    }
}
