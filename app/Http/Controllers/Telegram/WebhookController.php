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

class WebhookController extends Controller
{
    private string $outgoing_message = '';
    private array $outgoing_keyboard = [];

    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();

        $sender_id = $validated['message']['from']['id'];
        $sender_username = $validated['message']['from']['username'];
        $incoming_message = $validated['message']['text'];

        $user_message_role_list = [];
        $user = User::where('tg_user_id', $sender_id)->first();
        if ($user) {

            foreach ($user->roles as $user_role) {
                $user_message_role_list[] = $this->defineMessageToRole($user_role->name, $sender_id, $incoming_message);
            }

        } else {
            $user = User::where('tg_username', $sender_username)->first();
            if ($user) {
                $user->tg_user_id = $sender_id;
                $user->save();

                foreach ($user->roles as $user_role) {
                    $user_message_role_list[] = $this->defineMessageToRole($user_role->name, $sender_id, $incoming_message);
                }

            } else {
                $user_message_role_list[] = new MessageDefault($sender_id, $incoming_message);
            }
        }

        foreach ($user_message_role_list as $message_user_role) {
            $message_and_keyboard = $message_user_role->defineMessage();
            $this->outgoing_message .= $message_and_keyboard['message'];
            $this->outgoing_keyboard = $message_and_keyboard['keyboard'];
        }
        app(Telegram::class)->sendMessage($sender_id, $this->outgoing_message,
            $this->outgoing_keyboard);
    }

    private function defineMessageToRole($role_name, $sender_id, $incoming_message): MessageAdministrator|MessageDefault|MessageTeacher|MessageAssistant|MessageStudent
    {
        return match ($role_name) {
            'administrator' => new MessageAdministrator($sender_id, $incoming_message),
            'teacher' => new MessageTeacher($sender_id, $incoming_message),
            'assistant' => new MessageAssistant($sender_id, $incoming_message),
            'student' => new MessageStudent($sender_id, $incoming_message),
            default => new MessageDefault($sender_id, $incoming_message),
        };
    }
}
