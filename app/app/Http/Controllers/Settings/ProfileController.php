<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user wallet.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $breadcrumb = [
            [
                'link' => route('setting.profile'),
                'title' => 'Settings'
            ],
            [
                'link' => route('setting.profile'),
                'title' => 'Profile'
            ]
        ];

        return view('setting.profile', [
            'user' => $user,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'phone' => 'nullable',
            'photo' => ['nullable', 'image:jpeg,jpg,png'],
            'btc' => 'nullable',
            'eth' => 'nullable',
            'dge' => 'nullable',
            'ltc' => 'nullable',
            'bch' => 'nullable',
        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => auth_user()->email,
        ];

        if ($request->hasFile('photo')) {
            $data['image_path'] = $request->file('photo')->store('files');
        }

        if (!empty($request->input('country'))) {
            $data['country'] = $request->input('country');
        }

        if (!empty($request->input('state'))) {
            $data['state'] = $request->input('state');
        }

        if (!empty($request->input('city'))) {
            $data['city'] = $request->input('city');
        }

        if (!empty($request->input('phone'))) {
            $data['phone'] = $request->input('phone');
        }
        if (!empty($request->input('btc'))) {
            $data['btc'] = $request->input('btc');
        }
        if (!empty($request->input('eth'))) {
            $data['eth'] = $request->input('eth');
        }
        if (!empty($request->input('dge'))) {
            $data['dge'] = $request->input('dge');
        }
        if (!empty($request->input('ltc'))) {
            $data['ltc'] = $request->input('ltc');
        }
        if (!empty($request->input('bch'))) {
            $data['bch'] = $request->input('bch');
        }

        
        tap($user)->update($data);
        Session::flash('alert', 'success');
        Session::flash('message', 'Account Updated Successfully');
            
       

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully');
    }
}
