<?php

namespace App\Events;

use App\Models\Listing;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobEnquired
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $listing;
    public $enquirerEmail;

    public function __construct(Listing $listing, string $enquirerEmail)
    {
        $this->listing = $listing;
        $this->enquirerEmail = $enquirerEmail;
    }
}
