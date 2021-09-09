<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendContactReply extends Mailable
{
    use Queueable, SerializesModels;
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
        $email = env('MAIL_FROM_ADDRESS');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contact = $this->contact;

        if (!empty($contact)) {
            $generalSettings = getGeneralSettings();
            return $this->subject($contact->subject)
                ->from$this->email)
                ->view('web.default.emails.contact', [
                    'contact' => $contact,
                  
                ]);
        }
    }
}
