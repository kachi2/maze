<?php
/**
 * Created by PhpStorm.
 * User: billi
 * Date: 6/3/19
 * Time: 11:24 PM
 */

namespace App\Http\Controllers\Admin;

use Notifiable;
use App\Mail\MessageUsers;
use App\User;
use App\Notifications\MessageUser;
use App\UserNotify;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\UserEmail;

class MessageController extends Controller
{
    /**
     * Show the admin home page.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $breadcrumb = [
            [
                'link' => route('admin.message_users'),
                'title' => 'Massage Users'
            ]
        ];

        return view('admin.send-message', [
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * Do messgae User.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function doMessageUsers(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
            'recipients' => 'required'
        ]);

        $subject = $request->input('subject');
        $text = $request->input('message');
        $recipients = $request->input('recipients');
        
        foreach ($recipients as $user) {
            $usz = User::where('email', $user)->first();
           
            if($usz){
          //  try {  
                //dd($usz);
           // Mail::to($usz->email)->send( new UserEmail($usz));
             $usz->notify(new MessageUser($usz, $text, $subject));
           // } catch (\Exception $e) {
           // }
        }
    }
        return redirect()->back()->with('success', 'Users messaged successfully');
    }
}
