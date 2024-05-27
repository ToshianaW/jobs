<?php

namespace App\Listeners;

use App\Events\JobEnquired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\EnquiryNotification;

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
        // Log entering the handle method
        Log::info('Handling JobEnquired event', ['listing' => $event->listing->id, 'enquirerEmail' => $event->enquirerEmail]);

        try {
            // Log the email details
            Log::info('Sending enquiry email to: ' . $event->listing->user->email);
            Log::info('Enquirer email: ' . $event->enquirerEmail);

            // Send email to the owner of the listing
            Mail::to($event->listing->user->email)->send(new EnquiryNotification($event->listing, $event->enquirerEmail));

            // Log successful email sending
            Log::info('Enquiry email sent successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to send enquiry email', ['error' => $e->getMessage()]);

            // Re-throw the exception to mark the job as failed
            throw $e;
        }
    }
}

