<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel; //
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel; //
use Illuminate\Broadcasting\PresenceChannel; // Podemos determinar si un usuario se encuentra conectado o desconectado a un canal
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
    $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('example');
        // return new Channel('example');
        // return new Channel('users.' . $this->message->to_id); // Canal público
        return new PrivateChannel('users.' . $this->message->to_id);

    }
}
