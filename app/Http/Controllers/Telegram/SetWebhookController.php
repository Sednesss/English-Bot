<?php

namespace App\Http\Controllers\Telegram;

use App\Helpers\Telegram;
use App\Http\Requests\Telegram\SetWebHookRequest;

class SetWebhookController extends BaseController
{
    public function __construct(Telegram $telegram)
    {
        parent::__construct($telegram);
    }

    public function setWebhook(SetWebHookRequest $request)
    {
        $validated = $request->validated();

        $url = $validated['url'];
        $result = $this->telegram->setWebhook($url);

        dd(json_decode($result->body()), $url);
    }
}
