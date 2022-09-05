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
    private array $outgoing_keyboard = ['keyboard' => []];
    private array $user_role_handler_list = [];

    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();

        $sender_id = $validated['message']['from']['id'];
        $sender_username = $validated['message']['from']['username'];
        $incoming_message = $validated['message']['text'];

        $this->defineUserRoles($sender_id, $sender_username, $incoming_message);

        foreach ($this->user_role_handler_list as $user_role_handler) {
            $message_and_keyboard = $user_role_handler->defineMessage();
            $this->outgoing_message .= $message_and_keyboard['message'];
            $this->editButtons($message_and_keyboard['keyboard']);
        }
        app(Telegram::class)->sendMessage($sender_id, $this->outgoing_message,
            $this->outgoing_keyboard);
    }

    private function defineUserRoles($sender_id, $sender_username, $incoming_message)
    {
        $user = User::where('tg_user_id', $sender_id)->first();
        if ($user) {

            $user_roles = $user->roles;
            if ($user_roles) {
                foreach ($user_roles as $user_role) {
                    $this->user_role_handler_list[] = $this->getRoleHandler($user_role->name, $user, $incoming_message);
                }
            } else {
                $this->user_role_handler_list[] = new MessageDefault();
            }

        } else {
            $user = User::where('tg_username', $sender_username)->first();
            if ($user) {
                $user->tg_user_id = $sender_id;
                $user->save();

                $user_roles = $user->roles;
                if ($user_roles) {
                    foreach ($user_roles as $user_role) {
                        $this->user_role_handler_list[] = $this->getRoleHandler($user_role->name, $user, $incoming_message);
                    }
                } else {
                    $this->user_role_handler_list[] = new MessageDefault();
                }

            } else {
                $this->user_role_handler_list[] = new MessageDefault();
            }
        }
    }

    private function getRoleHandler($role_name, $user, $incoming_message): MessageAdministrator|MessageDefault|MessageTeacher|MessageAssistant|MessageStudent
    {
        return match ($role_name) {
            'administrator' => new MessageAdministrator($user, $incoming_message),
            'teacher' => new MessageTeacher($user, $incoming_message),
            'assistant' => new MessageAssistant($user, $incoming_message),
            'student' => new MessageStudent($user, $incoming_message),
            default => new MessageDefault(),
        };
    }

    private function editButtons($new_buttons)
    {
        if (array_key_exists('keyboard', $new_buttons)) {
            foreach ($new_buttons['keyboard'] as $button_line) {
                if (!in_array($button_line, $this->outgoing_keyboard['keyboard'])) {
                    $this->outgoing_keyboard['keyboard'][] = $button_line;
                }
            }
        }
    }

}
