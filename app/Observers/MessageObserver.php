<?php

namespace App\Observers;

use App\Message;
use App\Conversation;
use App\Events\MessageSent;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        // cuando el usuario ve, su propio comentario enviado
        // actualizar la conversacion desde el punto de vista que envia el mensaje
        $conversation = Conversation::where('user_id', $message->from_id)
                            ->where('contact_id', $message->to_id)->first();
        
        if($conversation){
            $conversation->last_message = "Tú: $message->content";
            $conversation->last_time = $message->created_at;
            $conversation->save(); 
        }

        // actualizar la conversacion desde el sentido  quien recive el mensaje
        $conversation = Conversation::where('contact_id', $message->from_id)
                            ->where('user_id', $message->to_id)->first();
        
        if($conversation){
            $conversation->last_message = "$conversation->contact_name: $message->content";
            $conversation->last_time = $message->created_at;
            $conversation->save();
        }

        event(new MessageSent($message));
    }
}
