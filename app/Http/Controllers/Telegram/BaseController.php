<?php

namespace App\Http\Controllers\Telegram;

use App\Helpers\Telegram;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BaseController extends Controller
{
    protected Telegram $telegram;

    public function __construct()
    {
        $this->telegram = new Telegram(new Http());
    }
}
