<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\WebhookRequest;
use App\Services\MessageAdministrator;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();

        $sender = new MessageAdministrator();
        $sender->getMessage($validated['message']['from']['id'], $validated['message']['text']);

    }
}
