<?php

namespace App\Console\Commands;

use App\Helpers\Telegram;
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
    protected $signature = 'telegram:notify';

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
        $all_users = User::all();
//        $notification_interval = NotificationInterval::where('selected', 1)->first()->time;

        foreach ($all_users as $user) {

            $context = [
                'user' => $user,
            ];
            $message = (string)view('Telegram/notify/NotifyUsersAboutTheLesson', $context);
            app(Telegram::class)->sendMessage($user->tg_user_id, $message, ['remove_keyboard' => true]);

        }
        echo("\n   good");
    }
}
