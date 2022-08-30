<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Applied
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $applicant;
    public $owner;
    public $description;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($applicant, $owner, $description)
    {
        $this->applicant = $applicant;
        $this->owner = $owner;
        $this->description = $description;
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
