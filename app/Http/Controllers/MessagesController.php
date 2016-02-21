<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageRequest;

class MessagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function inbox($user_id = null) {
        if(!is_numeric($user_id) || $user_id < 1) {
            $last_msg = Message::latest()->whereRaw("from_user_id = '".Auth::user()->id."' OR to_user_id = '".Auth::user()->id."'")->first();
            if($last_msg != null) {
                $user_id = ($last_msg->from_user_id == Auth::user()->id) ? $last_msg->to_user_id : $last_msg->from_user_id;
            }
        }
        
        if(is_numeric($user_id) && $user_id > 0) {
            $messages = Message::whereRaw("(from_user_id = '".Auth::user()->id."' AND to_user_id = '".$user_id."') OR (to_user_id = '".Auth::user()->id."' AND from_user_id = '".$user_id."')")->get();
            $chat_with = DB::select( DB::raw("SELECT DISTINCT(users.id), users.first_name, users.last_name, users.avatar FROM users JOIN messages ON ((messages.from_user_id = users.id AND messages.to_user_id = ".Auth::user()->id.") OR (messages.to_user_id = users.id AND messages.from_user_id = ".Auth::user()->id.")) WHERE 1 ORDER BY messages.created_at DESC") );
        } else {
            $messages = [];
            $chat_with = [];
        }
        
        return view('messages.inbox', compact('messages', 'chat_with', 'user_id'));
    }
    
    public function send(MessageRequest $request) {
        $message = new Message;
        $message->message = $request->input('message');
        $message->from_user_id = Auth::user()->id;
        $message->to_user_id = $request->input('user_id');

        $message->save();
            
        return redirect('/inbox/'.$request->input('user_id'));
    }
}