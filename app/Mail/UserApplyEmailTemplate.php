<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserApplyEmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $owner;
    public $description;
    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.apply-notification');
    }
}
