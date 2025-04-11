<?php

namespace App\Http\Controllers;

use App\Models\Message;
//use App\Events\MessageSent;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ChatsController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $message = $user->messages()->create([
            'message' => $request->message
        ]);

        //broadcast(new MessageSent(auth()->user(), $message))->toOthers();
        //Notification::send(auth()->user(), new NewChat($message));
        return ['status' => 'Message Sent!'];
    }
}
