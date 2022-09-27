<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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
       
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin%2Cethereum%2Clitecoin%2Cdogecoin%2Cusd-coin%2Cbinancecoin%2Ctron%tezos%2Chelium&order=market_cap_desc&per_page=8&page=1&sparkline=false&price_change_percentage=2');
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true); 
        $se = curl_exec($cURLConnection);
        curl_close($cURLConnection);  
        $resp = json_decode($se, true);
        if(empty($resp)){
            $resp = [];
        }
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
        Session::flash('msg', 'Message successfully Sent');
        Session::flash('alert', 'success');
        return redirect()->back()->with('status', 'Message successfully Sent');
    }
}
