<?php

namespace App\Http\Controllers\Telegram;

use App\Helpers\MessageForUser;
use App\Helpers\MessagesTemplates;
use App\Helpers\Telegram;
use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\WebhookRequest;
use App\Models\User;
use App\Services\MessageAdministrator;
use App\Services\MessageAssistant;
use App\Services\MessageWithoutRole;
use App\Services\MessageStudent;
use App\Services\MessageTeacher;

class WebhookController extends Controller
{
    private array $user_role_handler_list = [];
    public MessageForUser $message_for_user;
    public MessagesTemplates $message_templates;

    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();

        $sender_id = $validated['message']['from']['id'];
        $sender_username = $validated['message']['from']['username'];
        $incoming_message = $validated['message']['text'];

        $this->message_for_user = new MessageForUser();

        $this->defineUserHandlerToRoles($sender_id, $sender_username, $incoming_message);

        foreach ($this->user_role_handler_list as $user_role_handler) {
            $message_and_keyboard = $user_role_handler->defineMessage();
            $this->message_for_user->editMessage($message_and_keyboard['message']);
            $this->message_for_user->editButtons($message_and_keyboard['keyboard']);
        }

        app(Telegram::class)->sendMessage($sender_id, $this->message_for_user->getMessage(),
            $this->message_for_user->getButtons());
    }

    private function defineUserHandlerToRoles($sender_id, $sender_username, $incoming_message)
    {
        $user = User::where('tg_user_id', $sender_id)->first();
        if ($user) {

            $this->checkForUserRights($user, $incoming_message);

        } else {
            $user = User::where('tg_username', $sender_username)->first();
            if ($user) {
                $user->tg_user_id = $sender_id;
                $user->save();
//                app(Telegram::class)->sendMessage($sender_id, 'Поздравляю, вы были зарегистрированы',
//                    $this->message_for_user->getButtons());

                $this->checkForUserRights($user, $incoming_message);

            } else {
                $this->user_role_handler_list[] = new MessageWithoutRole($this->message_templates, $incoming_message);
            }
        }
        //Обработчик пустого ответа
    }

    private function checkForUserRights($user, $incoming_message)
    {
        $this->message_templates = new MessagesTemplates($user);
        $user_roles = $user->roles;
        if ($user_roles) {
            foreach ($user_roles as $user_role) {
                $this->user_role_handler_list[] = $this->getRoleHandler($user_role->name, $incoming_message);
            }
        } else {
            $this->user_role_handler_list[] = new MessageWithoutRole($this->message_templates, $incoming_message);
        }
    }

    private function getRoleHandler($role_name, $incoming_message): MessageAdministrator|MessageWithoutRole|MessageTeacher|MessageAssistant|MessageStudent
    {
        return match ($role_name) {
            'administrator' => new MessageAdministrator($this->message_templates, $incoming_message),
            'teacher' => new MessageTeacher($this->message_templates, $incoming_message),
            'assistant' => new MessageAssistant($this->message_templates, $incoming_message),
            'student' => new MessageStudent($this->message_templates, $incoming_message),
            default => new MessageWithoutRole($this->message_templates, $incoming_message),
        };
    }
}
