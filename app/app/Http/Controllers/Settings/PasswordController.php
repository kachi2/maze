<?php

namespace App\Http\Controllers\Settings;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
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
                'link' => route('setting.password'),
                'title' => 'Password'
            ]
        ];

        return view('account.settings', [
            'user' => $user,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Update the user's password.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'old_password' => 'required|old_password:' . Auth::user()->password,
            'password' => 'required|min:6',
        ]);

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
       Session::flash('alert', 'success');
        Session::flash('message', 'Password Changed Successfully');
        return redirect()
            ->back()
            ->with('success', 'Password updated successfully');
    }
}
