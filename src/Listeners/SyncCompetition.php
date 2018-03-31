<?php

namespace Partymeister\Competitions\Listeners;

use Partymeister\Competitions\Events\CompetitionSaved;
use Partymeister\Core\Events\EventSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncCompetition
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
    public function handle(CompetitionSaved $event)
    {
        \Partymeister\Competitions\Jobs\SyncCompetition::dispatch($event->competition);
    }
}
