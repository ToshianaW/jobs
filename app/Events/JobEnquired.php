<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobEnquired
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $listing;
    public $enquirerEmail;

    /**
     * Create a new event instance.
     *
     * @param Listing $listing
     * @param string $enquirerEmail
     */

    public function __construct(Listing $listing, string $enquirerEmail)
    {
        $this->listing = $listing;
        $this->enquirerEmail = $enquirerEmail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
