<?php

namespace App\Listeners;

use App\Events\JobEnquired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEnquiryNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\JobEnquired  $event
     * @return void
     */
    public function handle(JobEnquired $event)
    {
        // Send email to the owner of the listing
        Mail::to($event->listing->user->email)->send(new EnquiryNotification($event->listing, $event->enquirerEmail));
    }
}
