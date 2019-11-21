<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class contactMessageEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $email;
    public $bodyMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject, $email, $message)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->email = $email;
        $this->bodyMessage = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        sleep(10);
        
        return $this->subject($this->subject)
                    ->from($this->email)
                    ->to('test-4aadc6@inbox.mailtrap.io')
                    ->view('emails.contactMessage');
    }
}
