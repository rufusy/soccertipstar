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
    public function __construct($new_user)
    {
        $this->password = $new_user['password'];
        $this->first_name = $new_user['first_name'];
        $this->last_name = $new_user['last_name'];
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
