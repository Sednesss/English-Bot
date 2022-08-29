<?php

namespace App\Http\Controllers\Telegram;

use App\Helpers\Telegram;
use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\WebhookRequest;
use App\Models\User;
use App\Services\MessageAdministrator;
use App\Services\MessageAssistant;
use App\Services\MessageDefault;
use App\Services\MessageStudent;
use App\Services\MessageTeacher;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();

        $sender_id = $validated['message']['from']['id'];
        $sender_username = $validated['message']['from']['username'];
        $incoming_message = $validated['message']['text'];
        $outgoing_message = '';

        $user = User::where('tg_user_id', $sender_id)->first();
        if ($user) {
            $user_message_role_list = [];
            foreach ($user->roles as $user_role) {
                $user_message_role_list[] = $this->defineMessageToRole($user_role->name);
            }
        } else {
            $user = User::where('tg_username', $sender_username)->first();
            if ($user) {
                $user->tg_user_id = $sender_id;
                $user->save();

                $user_message_role_list = [];
                foreach ($user->roles as $user_role) {
                    $user_message_role_list[] = $this->defineMessageToRole($user_role->name);
                }
            } else {
                $user_message_role_list[] = new MessageDefault();
            }
        }
        foreach ($user_message_role_list as $message_user_role) {
            $outgoing_message = $message_user_role->defineMessage($sender_id, $incoming_message);
            echo 1;
        }
        app(Telegram::class)->sendMessage($sender_id, $outgoing_message['message'], $outgoing_message['keyboard']);
    }

    private function defineMessageToRole($role_name): MessageAdministrator|MessageDefault|MessageTeacher|MessageAssistant|MessageStudent
    {
        return match ($role_name) {
            $role_name == 'administrator' => new MessageAdministrator(),
            $role_name == 'teacher' => new MessageTeacher(),
            $role_name == 'assistant' => new MessageAssistant(),
            $role_name == 'student' => new MessageStudent(),
            default => new MessageDefault(),
        };
    }
}
