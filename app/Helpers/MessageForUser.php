<?php

namespace App\Helpers;

class MessageForUser
{
    private array $buttons = ['keyboard' => []];
    private string $message = '';

    public function editButtons($new_buttons): void
    {
        if (array_key_exists('keyboard', $new_buttons)) {
            foreach ($new_buttons['keyboard'] as $button_line) {
                if (!in_array($button_line, $this->buttons['keyboard'])) {
                    $this->buttons['keyboard'][] = $button_line;
                }
            }
        }
    }

    public function editMessage($new_message): void
    {
        if ($this->message == '' && $new_message != '') {
            $this->message = $new_message;
        }
    }

    public function getButtons(): array
    {
        return $this->buttons;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

}
