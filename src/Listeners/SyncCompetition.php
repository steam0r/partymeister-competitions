<?php

namespace Partymeister\Competitions\Listeners;

use Partymeister\Competitions\Events\CompetitionSaved;
use Partymeister\Core\Events\EventSaved;

/**
 * Class SyncCompetition
 * @package Partymeister\Competitions\Listeners
 */
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
     * @param CompetitionSaved $event
     */
    public function handle(CompetitionSaved $event)
    {
        \Partymeister\Competitions\Jobs\SyncCompetition::dispatch($event->competition);
    }
}
