<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    public function index(Request $request ) {

        $userId = auth()->id();

        $contactId = $request->contact_id;

        return Message::select(
            'id', 
            // agregar una columna personalizada, de tipo Boolean
            DB::raw("IF(`from_id`=$userId, TRUE, FALSE) as written_by_me"), 
            'content', 
            'created_at'
        )->where( function(Builder $query) use($userId, $contactId) { // use es para poder usar estas 2 variables
            $query->where('from_id', $userId)->where('to_id', $contactId);
        })->orWhere(function(Builder $query) use($userId, $contactId) {
            $query->where('from_id', $contactId)->where('to_id', $userId);
        })->get();

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
