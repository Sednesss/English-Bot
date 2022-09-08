<?php

namespace App\Helpers;

use App\Models\User;

class MessagesTemplates
{
    private string $view_template_path = 'Telegram/responses/';
    private string $view_template_filename;
    private array $context = [];
    private mixed $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function GetResponseMessage($pressed_button = ''): string
    {
        switch ($pressed_button) {
            case 'Информация об аккаунте':
                $this->GetUserInfo();
                break;
            case 'Оповестить всех':
                $this->NotifyEveryone();
                break;
            case 'Отправить домашнее задание':
                $this->SendHomework();
                break;
            case 'Отправить сопровождающий материал':
                $this->SendMaterial();
                break;
            case 'Редактировать расписание':
                $this->EditTimetable();
                break;
            case 'Редактировать учебное пособие':
                $this->EditTutorial();
                break;
            case 'Информация о группе':
                $this->GetGroupInfo();
                break;
            case 'Включить уведомления':
                $this->TurnNotifications();
                break;
            case 'Домашнее задание':
                $this->GetHomework();
                break;
            case 'Сопровождающий материал':
                $this->GetMaterial();
                break;
            case 'Расписание':
                $this->GetTimetable();
                break;
            case 'Учебное пособие':
                $this->GetTutorial();
                break;
            case '/default_message':
                $this->DefaultMessage();
                break;
            case '/non-text_format':
                $this->NonTextFormat();
                break;
            default:
                $this->UserNotFound();
                break;
        }
        return (string)view($this->view_template_path . $this->view_template_filename, $this->context);
    }

    private function GetUserInfo(): void
    {
        $this->view_template_filename = 'AllRole/PushGetUserInfo';
        $this->context = [
            'user' => $this->user,
        ];
    }

    private function DefaultMessage(): void
    {
        $this->view_template_filename = 'AllRole/DefaultMessage';
    }

    private function NotifyEveryone(): void
    {
        $this->view_template_filename = 'Administrator/PushNotifyEveryoneMessage';
    }

    private function SendHomework(): void
    {
        $this->view_template_filename = 'Teacher/PushSendHomeworkMessage';
    }

    private function SendMaterial(): void
    {
        $this->view_template_filename = 'Teacher/PushSendMaterialMessage';
    }

    private function EditTimetable(): void
    {

        $this->view_template_filename = 'TeacherAndAssistant/PushEditTimetableMessage';
    }

    private function EditTutorial(): void
    {
        $this->view_template_filename = 'TeacherAndAssistant/PushEditTutorialMessage';
    }

    private function GetGroupInfo(): void
    {
        $this->view_template_filename = 'TeacherAndAssistantAndStudent/PushGetGroupInfo';
    }

    private function TurnNotifications(): void
    {
        $this->view_template_filename = 'TeacherAndAssistantAndStudent/PushOnOffNotificationsMessage';
    }

    private function GetHomework(): void
    {
        $this->view_template_filename = 'Student/PushGetHomeworkMessage';
    }

    private function GetMaterial(): void
    {
        $this->view_template_filename = 'Student/PushGetMaterialMessage';
    }

    private function GetTimetable(): void
    {
        $this->view_template_filename = 'Student/PushGetTimetableMessage';
    }

    private function GetTutorial(): void
    {
        $this->view_template_filename = 'Student/PushGetTutorialMessage';
    }

    private function UserNotFound(): void
    {
        $this->view_template_filename = 'WithoutRole/UserNotFound';

        $administrators = User::role('administrator')->pluck('tg_username');
        $this->context = [
            'administrators' => $administrators,
        ];

    }
    private function NonTextFormat(): void
    {
        $this->view_template_filename = 'AllRole/SentInNonTextFormat';
    }
}
