<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Requests\Telegram\SetWebHookRequest;

class SetWebhookController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setWebhook(SetWebHookRequest $request)
    {
        $validated = $request->validated();

        $url = $validated['url'];
        $result = $this->telegram->setWebhook($url);

        dd(json_decode($result->body()), $url);
    }
}
