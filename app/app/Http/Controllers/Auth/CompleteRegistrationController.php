<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserWallet;
use Illuminate\Validation\ValidationException;

class CompleteRegistrationController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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

        return view('auth.complete_registration', [
            'user' => $user,
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
            //'first_name' => ['required', 'string', 'max:120'],
            //'last_name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'alpha_num', 'max:120', 'unique:users'],
            'country' => 'nullable',
            'phone' => 'nullable',
            'state'=>'nullable'
        ]);

        //$firstName = $request->input('first_name');
        //$lastName = $request->input('last_name');
        $username = $request->input('username');
        //$photoSavePath = $request->file('photo')->store('files');


        $data = [
            'username' => $username,
            //'first_name' => $firstName,
            //'last_name' => $lastName,
            //'image_path' => $photoSavePath
        ];

        if (!empty($request->input('phone'))) {
            $data['phone'] = $request->input('phone');
        }
        if (!empty($request->input('phone'))) {
            $data['country'] = $request->input('country');
        }
        if (!empty($request->input('phone'))) {
            $data['state'] = $request->input('state');
        }

        $bonusAmount = 20;
        tap($user)->update($data);
        UserWallet::addBonus($user, $bonusAmount);

        return redirect()
            ->to($request->input('redirect') ?? $this->redirectTo)
            ->with('success', 'Registration completed successfully');
    }
}
