<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Register;
use App\Models\Referral;
use App\Models\UserWallet;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        registered as protected traitRegistered;
    }

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'first_name' => ['required', 'string', 'max:120'],
            //'last_name' => ['required', 'string', 'max:120'],
            //'username' => ['required', 'alpha_num', 'max:120', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'alpha_num', 'max:120', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create_user(Request $data)
    {
        
         $validate = $this->validate($data, [
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        if(!$validate){
            return back()->withInput($data->all())->InputErrors($validate);
        }

        $name = explode(' ',$data['full_name']);
        if($name[0]){
            $first_name = $name[0];
        }
        if($name[1]){ 
            $last_name = $name[1];
        }
        $userIp = request()->getClientIp();
        $details = json_decode(file_get_contents("https://ipinfo.io/$userIp/json"));
        if(isset($details->city)) {
          $city = $details->city;
          $country = $details->country;
        }
        $username = $first_name.rand(111,999);
        
        $create =  User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $data['email'],
            'city' => $city,
            'country' => $country,
            'username' =>  $username,
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        
        if($create){
            $users = User::latest()->first();
           $bonusAmount = 0;
        UserWallet::addBonus($users, $bonusAmount);
        Auth::login($users);
        return redirect()
            ->to($this->redirectTo);
    }
    }

    protected function registered(Request $request, $user)
    {
        try {
            if (session('ref')) {
                $ref = User::whereUsername(session('ref'))->first();
                if ($ref) {
                    $this->saveRef($user, $ref);
                }
            }
            Mail::send(new Register($user));
        } catch (Exception $e) {

        }

        
        return $this->traitRegistered($request, $user);
    }

    protected function saveRef(User $user, User $ref) {
        Referral::create([
            'ref' => generate_reference(),
            'user_id' => $user->id,
            'referrer_id' => $ref->id,
            'interest' => 0
        ]);
    }
    
}
