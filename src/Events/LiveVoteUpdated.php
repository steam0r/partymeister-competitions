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
use Partymeister\Competitions\Models\LiveVote;

class LiveVoteUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $liveVote;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(LiveVote $liveVote)
    {
        $this->liveVote = $liveVote;
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
