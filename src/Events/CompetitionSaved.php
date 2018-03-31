<?php

namespace Partymeister\Competitions\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Partymeister\Competitions\Models\Competition;

class CompetitionSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $competition;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
