<?php

namespace App\Mail;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Listing $listing;
    public string $enquirerEmail;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enquiry')
            ->with([
                'listingTitle' => $this->listing->title,
                'enquirerEmail' => $this->enquirerEmail,
            ]);
    }
}
