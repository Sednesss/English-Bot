<?php

namespace App\Services\Telegram;


class MessageAssistant extends BaseMessageRole
{
    public function __construct($messages_templates)
    {
        parent::__construct($messages_templates);
        $this->commands = [
            'Информация об аккаунте',
            'Информация о группе',
            'Редактировать расписание',
            'Редактировать учебное пособие',
            'Включить уведомления'
        ];
    }
}
