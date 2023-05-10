<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function getMessages() {
        $users = User::all();
        $messages = Message::where('receiver_id', Auth::user()->id)->get();
        
        return view('/messages', compact('messages', 'users'));
    }

    public function getSendMessage() {
        $users = User::all();
        
        return view('/sendmessage', compact('users'));
    }

    public function sendMessage(Request $request) {
        $request->validate([
            'subject' => 'required|min:2|max:255|string',
            'content' => 'required|min:2|max:5000|string',
            'id' => 'required|exists:users,id'
        ]);

        $message = new Message();
        $message->subject = $request->subject;
        $message->content = $request->content;
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request->id;
        $message->save();

        return redirect('/messages')->with('status', 'Message successfully sent.');
    }
}
