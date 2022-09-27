<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Withdrawal;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserActivity;
use App\UserNotify;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('showPhoto');;
    }

    /**
     * Display user wallet.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $breadcrumb = [
            [
                'link' => route('account'),
                'title' => 'Account'
            ]
        ];

        $totalDeposits = $user->deposits()->sum('amount');
        $activeDeposits = $user->deposits()->whereStatus(Deposit::STATUS_ACTIVE)->sum('amount');
        $lastDeposit = $user->deposits()->take(1)->sum('amount');

        $totalWithdrawals = $user->withdrawals()->where('status', '!=', Withdrawal::STATUS_CANCELED)->sum('amount');
        $pendingWithdrawals = $user->withdrawals()->whereStatus(Withdrawal::STATUS_PENDING)->sum('amount');
        $lastWithdrawal = $user->withdrawals()->where('status', '!=', Withdrawal::STATUS_CANCELED)->latest()->take(1)->sum('amount');

        return view('mobile.settings', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'total_deposits' => $totalDeposits,
            'active_deposits' => $activeDeposits,
            'last_deposit' => $lastDeposit,
            'total_withdrawals' => $totalWithdrawals,
            'pending_withdrawals' => $pendingWithdrawals,
            'last_withdrawal' => $lastWithdrawal
        ]);
    }
 
    /**
     * Update the user's profile information.
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id = null)
    {
        if (!is_null($id)) {
            $user = User::findOrFail($id);
            if (!((bool)$request->user()->is_admin)) {
                throw new UnauthorizedHttpException();
            }
        } else {
            
            $user = $request->user();
        }
        
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $user->id,
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
            'email', $email,
        ];

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
        
         return redirect()
            ->back()
            ->with('message', 'Profile updated successfully');
    }

    /**
     * show the user image for the given id.
     *
     * @param Request $request
     * @param int $id
     * @return BinaryFileResponse
     */
    public function showPhoto(Request $request, $id)
    {
        $user = User::findorfail($id);
        $img = Image::make(Storage::path($user->image_path));
        $height = $request->input('height');
        $width = $request->input('width');
        if ($height || $width) {
            $img->resize($width, $height);
        }
        return $img->response();
    }

    public function StorePhoto(Request $request)
    {
        $user = User::where('id', auth_user()->id)->first();
        $image = request()->file('image');
        $ext = $image->getClientOriginalExtension();
        $file = md5(time()).'.'.$ext;
        $image->move('images', $file);
        //Image::make($request->file('image'))->resize(200,200)->save('images',$file);
        $user->update([
        'image_path' => $file
        ]);
        return back();
    }

    public function activity(){
        return view('account.activity')
        ->with('users', UserActivity::where('user_id', auth_user()->id)->latest()->take(10)->get());
    }

    public function UserNotifications(){
        $notifications = UserNotify::where('user_id', auth_user()->id)->latest()->paginate(10);
        return view('mobile.notify', [
            'notifications' => $notifications
        ]);
    }
}
