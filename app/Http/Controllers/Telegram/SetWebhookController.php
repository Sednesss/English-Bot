<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;

class SetWebhookController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setWebhook(Request $request)
    {
        $result = $this->telegram->setWebhook();
        dd(json_decode($result->body()));
    }
}
