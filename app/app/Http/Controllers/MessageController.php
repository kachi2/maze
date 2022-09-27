<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    //


    public function index(){
        $message = Message::where('receiver_id', auth_user()->id)->orwhere('sender_id', auth_user()->id)->get();
        return view('mobile.messages', [ 'message' => $message]);
    }

    public function SendMessage(Request $request){
        $message = Message::create([
            'sender_id' => auth_user()->id,
            'receiver_id' => 4,
            'message' => $request->message,
            'status' => 0
        ]);

        if($message){

            return redirect()->route('users.messages.index');
        }


    }

    public function Agent(){
        return view('agent');
    }
}
