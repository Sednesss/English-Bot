<?php

namespace App\Console\Commands;

use App\Helpers\Telegram;
use App\Models\Telegram\Lesson;
use App\Models\Telegram\NotificationInterval;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

    private int $time_now;

    public function handle()
    {
        date_default_timezone_set('Asia/Krasnoyarsk');
        $this->time_now = time();
        $notification_intervals = NotificationInterval::where('selected', 1)->get();

        foreach ($notification_intervals as $notification_interval) {
            $nextLessons = array();

            if ($notification_interval->is_period == 1) {
                $nextLessons = Lesson::whereBetween('date', [
                    date('Y-m-d', $this->time_now + $this->stringTimeToIntegerDate($notification_interval->time) - 29),
                    date('Y-m-d', $this->time_now + $this->stringTimeToIntegerDate($notification_interval->time) + 29)
                ])->whereBetween('time', [
                    date('H:i:s', $this->time_now + $this->stringTimeToIntegerDate($notification_interval->time) - 29),
                    date('H:i:s', $this->time_now + $this->stringTimeToIntegerDate($notification_interval->time) + 29)
                ])->get();
            } else {

                if ($this->time_now - 29 <= strtotime($notification_interval->time, $this->time_now) &&
                    $this->time_now + 29 >= strtotime($notification_interval->time, $this->time_now)) {

                    $nextLessons = Lesson::whereBetween('date', [
                        date('Y-m-d', strtotime($notification_interval->time) - 29),
                        date('Y-m-d', strtotime('23:59:59'))
                    ])->whereBetween('time', [
                        date('H:i:s', strtotime($notification_interval->time) - 29),
                        date('H:i:s', strtotime('23:59:59'))
                    ])->get();
                }
            }

            if (count($nextLessons) != 0) {
                foreach ($nextLessons as $nextLesson) {
                    $group = $nextLesson->group;
                    $teachers = $group->teachers;

                    $context = [
                        'group' => $group,
                        'teachers' => $teachers,
                        'proposal' => $notification_interval->is_period == 1 ? 'через' : 'в',
                        'time' => $notification_interval->is_period == 1 ? $notification_interval->name : (string)$nextLesson->time
                    ];
                    foreach ($group->users as $user) {
                        if ($user->tg_user_id) {
                            $message = (string)view('Telegram/notify/NotifyUsersAboutTheLesson', $context);
                            app(Telegram::class)->sendMessage($user->tg_user_id, $message, ['remove_keyboard' => true]);
                        }
                    }
                }
            }
        }
    }

    private function stringTimeToIntegerDate($string_date): int
    {
        return date(strtotime($string_date, $this->time_now)) -
            strtotime(date('Y-m-d 00:00:00', $this->time_now));
    }
}
