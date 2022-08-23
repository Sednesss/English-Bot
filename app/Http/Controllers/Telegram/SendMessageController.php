<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Telegram;

class SendMessageController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Telegram();
    }

    public function sendMessage(Request $request)
    {
        $this->telegram->sendMessage(542017586, 'hello');
        dd(123);
    }
}
