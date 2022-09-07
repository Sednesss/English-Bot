<?php

namespace App\Console\Commands;

use App\Helpers\Telegram;
use App\Models\Telegram\Group;
use App\Models\Telegram\Lesson;
use App\Models\Telegram\NotificationInterval;
use App\Models\User;
use Illuminate\Console\Command;

class NotifyUsersAboutTheLesson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:notify {--before=} {--is_period=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about an upcoming lesson';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $before = $this->option("before");
        $isPeriod = $this->option("is_period");

        echo $before;
        echo $isPeriod;

        date_default_timezone_set('Asia/Krasnoyarsk');
        $nextLesson = Lesson::where('date', '>=', date('Y-m-d'))
            ->where('time', '>=', date('H:i:s'))
            ->orderBy('date')
            ->orderBy('time')
            ->first();

        $group = $nextLesson->group;
        $teachers = $group->teachers;

        $context = [
            'group' => $group,
            'teachers' => $teachers,
        ];

        foreach ($group->users as $user) {
            $message = (string)view('Telegram/notify/NotifyUsersAboutTheLesson', $context);
            app(Telegram::class)->sendMessage($user->tg_user_id, $message, ['remove_keyboard' => true]);
        }

        echo("\ngood\n");
    }
}
