<?php

namespace App\Services\Telegram;


class MessageStudent extends BaseMessageRole
{
    public function __construct($messages_templates)
    {
        parent::__construct($messages_templates);
        $this->commands = [
            'Информация об аккаунте',
            'Информация о группе',
            'Расписание',
            'Учебное пособие',
            'Домашнее задание',
            'Сопровождающий материал',
            'Включить уведомления'
        ];
    }
}
