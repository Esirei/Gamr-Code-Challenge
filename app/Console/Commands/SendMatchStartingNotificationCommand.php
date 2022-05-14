<?php

namespace App\Console\Commands;

use App\Models\Fixture;
use App\Notifications\MatchStartingNotification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SendMatchStartingNotificationCommand extends Command
{
    protected $signature = 'send:match-starting';

    protected $description = 'Sends a notification to Team Manager that a match is starting';

    public function handle()
    {
        Fixture::with(['homeTeam.user', 'awayTeam.user'])
            ->whereDate('date', now())
            ->whereTime('date', now())
            ->tap(fn(Builder $query) => $query->update(['status' => Fixture::ONGOING]))
            ->each(function (Fixture $match) {
                $match->homeTeam->user->notify(new MatchStartingNotification($match));
                $match->awayTeam->user->notify(new MatchStartingNotification($match));
            });
    }
}
