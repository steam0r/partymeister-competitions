<?php

namespace Partymeister\Competitions\Listeners;

use Partymeister\Competitions\Events\CompetitionSaved;
use Partymeister\Competitions\Events\LiveVoteUpdated;
use Partymeister\Core\Events\EventSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncLiveVote
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventSaved  $event
     * @return void
     */
    public function handle(LiveVoteUpdated $event)
    {
        \Partymeister\Competitions\Jobs\SyncLiveVote::dispatch($event->liveVote);
    }
}
