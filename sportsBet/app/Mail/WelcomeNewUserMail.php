<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeNewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $first_name;
    public $last_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $last_name, $password)
    {
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-welcome');
    }
}
