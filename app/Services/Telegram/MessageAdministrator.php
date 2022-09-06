<?php

namespace App\Services\Telegram;


class MessageAdministrator extends BaseMessageRole
{
    public function __construct($messages_templates)
    {
        parent::__construct($messages_templates);
        $this->commands = [
            'Информация об аккаунте',
            'Оповестить всех'
        ];
    }
}
