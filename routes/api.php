<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Telegram'], function () {
    Route::post('sendMessage', 'SendMessageController@sendMessage')->name('telegram.sendMessage');

    Route::post('setWebhook', 'SetWebhookController@setWebhook')->name('telegram.setWebhook');
    Route::post('webhook', 'WebhookController@index')->name('telegram.webhook');
});
