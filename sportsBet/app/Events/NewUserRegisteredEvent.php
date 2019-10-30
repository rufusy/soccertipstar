<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewUserRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $first_name;
    public $last_name;
    public $password;
    public $email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($newUserMailedData)
    {
        $this->first_name = $newUserMailedData['first_name'];
        $this->last_name = $newUserMailedData['last_name'];
        $this->password = $newUserMailedData['password'];
        $this->email = $newUserMailedData['email'];
    }

}
