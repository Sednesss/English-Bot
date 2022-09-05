<?php

namespace App\Helpers;

use App\Models\User;

class MessagesTemplates
{
    private string $view_template = 'Telegram/responses/';
    private array $context = [];
    private User $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function GetResponseMessage($pressed_button): string
    {
        switch ($pressed_button) {
            case 'Оповестить всех':
                $this->NotifyEveryone();
                break;
            default:
                $this->DefaultMessage();
                break;
        }
        return (string)view($this->view_template, $this->context);
    }

    private function DefaultMessage()
    {
        $this->view_template .= 'DefaultMessage';
        $this->context = [
            'user' => $this->user,
        ];
    }

    private function NotifyEveryone()
    {
        $this->view_template .= 'PushNotifyEveryoneMessage';
    }
}
