<?php

namespace App\Jobs;

use App\Models\Schedule;
use App\Notifications\WorkoutReminderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWorkoutReminderJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public Schedule $schedule) {}

    public function handle(): void
    {
        $this->schedule->load([
            'user',
            'plan'
        ]);

        $this->schedule
            ->user
            ->notify(
                new WorkoutReminderNotification($this->schedule)
            );
    }
}