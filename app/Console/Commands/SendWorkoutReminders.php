<?php

namespace App\Console\Commands;

use App\Jobs\SendWorkoutReminderJob;
use App\Models\Schedule;
use Illuminate\Console\Command;

class SendWorkoutReminders extends Command
{
    protected $signature = 'workout:reminders';

    protected $description = 'Send workout reminders';

    public function handle(): int
    {
        Schedule::query()
            ->whereNull('reminder_sent_at')
            ->whereBetween('scheduled_at', [
                now()->startOfMinute(),
                now()->endOfMinute(),
            ])
            ->with([
                'user',
                'plan',
            ])
            ->each(function (Schedule $schedule) {

                SendWorkoutReminderJob::dispatch($schedule);

                $schedule->update([
                    'reminder_sent_at' => now(),
                ]);
            });

        return self::SUCCESS;
    }
}
