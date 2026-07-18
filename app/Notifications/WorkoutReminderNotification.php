<?php

namespace App\Notifications;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WorkoutReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Schedule $schedule) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Hora do treino 💪')
            ->greeting("Olá {$notifiable->name}!")
            ->line('Está na hora do seu treino.')
            ->line("Treino: {$this->schedule->plan->name}")
            ->line("Horário: {$this->schedule->scheduled_at->format('d/m/Y H:i')}")
            ->success()
            ->line('Bom treino!');
    }
}