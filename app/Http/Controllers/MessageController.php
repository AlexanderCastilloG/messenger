<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index() {

        $userId = auth()->id();

        return Message::select(
            'id', 
            // agregar una columna personalizada, de tipo Boolean
            DB::raw("IF(`from_id`=$userId, TRUE, FALSE) as written_by_me"), 
            'content', 
            'created_at'
        )->get();
    }

    public function store(Request $request) {
        $message = new Message();
        $message->from_id = auth()->id();
        $message->to_id = $request->to_id;
        $message->content = $request->content;
        $saved = $message->save();

        $data = [];
        $data['success'] = $saved;
        return $data;
    }
}
