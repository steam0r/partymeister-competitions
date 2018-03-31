<?php

namespace Partymeister\Competitions\Listeners;

use Partymeister\Competitions\Events\EntrySaved;
use Partymeister\Slides\Events\SlideSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncEntry
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
     * @param  SlideSaved $event
     *
     * @return void
     */
    public function handle(EntrySaved $event)
    {
        \Partymeister\Competitions\Jobs\SyncEntry::dispatch($event->entry);
    }
}
