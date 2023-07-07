<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\MarketList;
use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $resp = MarketList::get();
        return view('contact-us')->with('coins', $resp);
    }

    /**
     * Store the contact us.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'subject' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required'
        ]);

        try {
            Mail::send('emails.contact-us-email', [
                'name' => $request->get('name'),
                'subject' => $request->get('subject'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'user_message' => $request->get('message')
            ], function ($message) use ($request) {
                $message->from($request->get('email'));
                $message->to(config('mail.contact_us_mail_address'), 'Admin')
                    ->subject(config('app.name') . ' Feedback');
            });

            $contact = ContactUs::create($request->all());
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to send message'])->withInput();
        }

        return redirect()->back()->with('status', 'Message successfully Sent');
    }
}
