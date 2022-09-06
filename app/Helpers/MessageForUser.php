<?php

namespace App\Helpers;

class MessageForUser
{
    private string $message;
    private array $commands = [];

    public function addCommands($user_role_handler_list): void
    {
        foreach ($user_role_handler_list as $user_role_handler) {
            foreach ($user_role_handler->GetCommands() as $new_button) {
                $this->commands[$new_button] = $new_button;
            }
        }
    }

    public function getButtons()
    {
        $keyboard = [];
        if (count($this->commands) > 0) {
            $keyboard = [
                'keyboard' => []
            ];

            foreach ($this->commands as $command) {
                $keyboard['keyboard'][][] = ['text' => $command];
            }
        } else {
            $keyboard = [
                'remove_keyboard' => true
            ];
        }


        return $keyboard;
    }


    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage($new_message): void
    {
        $this->message = $new_message;
    }

}
