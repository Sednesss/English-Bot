<?php

namespace App\Http\Controllers\Telegram;

use App\Helpers\MessageForUser;
use App\Helpers\MessagesTemplates;
use App\Helpers\Telegram;
use App\Http\Controllers\Controller;
use App\Http\Requests\Telegram\WebhookRequest;
use App\Models\User;
use App\Services\Telegram\MessageAdministrator;
use App\Services\Telegram\MessageAssistant;
use App\Services\Telegram\MessageStudent;
use App\Services\Telegram\MessageTeacher;
use App\Services\Telegram\MessageWithoutRole;

class WebhookController extends Controller
{
    private array $user_role_handler_list = [];
    public MessageForUser $message_for_user;
    public MessagesTemplates $message_templates;
    private bool $is_message_default = true;

    public function index(WebhookRequest $request)
    {
        $validated = $request->validated();

        $sender_id = $validated['message']['from']['id'];
        $sender_username = $validated['message']['from']['username'];
        $incoming_message = $validated['message']['text'];

        $this->message_for_user = new MessageForUser();

        $this->defineUserHandlerToRoles($sender_id, $sender_username);

        $this->message_for_user->addCommands($this->user_role_handler_list);

        foreach ($this->user_role_handler_list as $user_role_handler) {

            if ($user_role_handler->isHandlerToIncomingMessage($incoming_message)) {
                $this->is_message_default = false;
                $this->message_for_user->setMessage($user_role_handler->getMessage($incoming_message));
                break;
            }
        }

        $this->isMessageDefault();

        app(Telegram::class)->sendMessage($sender_id, $this->message_for_user->getMessage(),
            $this->message_for_user->getButtons());
    }

    private function defineUserHandlerToRoles($sender_id, $sender_username)
    {
        $user = User::where('tg_user_id', $sender_id)->first();
        if ($user) {

            $this->checkForUserRights($user);

        } else {

            $user = User::where('tg_username', $sender_username)->first();
            if ($user) {

                $user->tg_user_id = $sender_id;
                $user->save();
                app(Telegram::class)->sendMessage($sender_id, 'Поздравляю! Вы были зарегистрированы',
                    $this->message_for_user->getButtons());

                $this->checkForUserRights($user);

            } else {

                $this->message_templates = new MessagesTemplates(Null);
                $this->user_role_handler_list[] = new MessageWithoutRole($this->message_templates);
            }
        }
    }

    private function checkForUserRights($user)
    {
        $this->message_templates = new MessagesTemplates($user);
        $user_roles = $user->roles;
        if (count($user_roles) > 0) {
            foreach ($user_roles as $user_role) {
                $this->user_role_handler_list[] = $this->getRoleHandler($user_role->name);
            }
        } else {
            $this->user_role_handler_list[] = new MessageWithoutRole($this->message_templates);
        }
    }

    private function getRoleHandler($role_name): MessageAdministrator|MessageWithoutRole|MessageTeacher|MessageAssistant|MessageStudent
    {
        return match ($role_name) {
            'administrator' => new MessageAdministrator($this->message_templates),
            'teacher' => new MessageTeacher($this->message_templates),
            'assistant' => new MessageAssistant($this->message_templates),
            'student' => new MessageStudent($this->message_templates),
            default => new MessageWithoutRole($this->message_templates),
        };
    }

    private function isMessageDefault()
    {
        if ($this->is_message_default) {
            $this->message_for_user->setMessage($this->message_templates->GetResponseMessage('/default_message'));
        }
    }
}
