<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\WebhookRequest;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();
        Log::debug($validated);
    }
}
