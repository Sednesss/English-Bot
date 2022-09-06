<?php

namespace App\Services\Telegram;


class MessageWithoutRole extends BaseMessageRole
{

    public function __construct($messages_templates)
    {
        parent::__construct($messages_templates);
    }

    public function isHandlerToIncomingMessage($incoming_message): bool
    {
        return true;
    }

    public function getMessage($incoming_message): string
    {
        return $this->messages_templates->GetResponseMessage();
    }
}
