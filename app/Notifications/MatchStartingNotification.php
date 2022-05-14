<?php

namespace App\Notifications;

use App\Models\Fixture;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MatchStartingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Fixture $fixture)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $s = $this->fixture->home_team->name . " vs " . $this->fixture->away_team->name;
        return (new MailMessage)
            ->subject('Match Starting: ' . $s)
            ->line('The introduction to the notification.');
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
