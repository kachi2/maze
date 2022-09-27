<?php
/**
 * Created by PhpStorm.
 * User: COMPUTER
 * Date: 9/6/2017
 * Time: 11:26 AM
 */

namespace App\Http\Controllers\Admin;

use App\Notifications\MessageUser;
use App\Models\BonusHistory;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\Package;
use App\Models\Plan;
use App\Models\Resource;
use App\Models\State;
use App\Models\Trade;
use App\Models\UserWallet;
use App\Models\Withdrawal;
use App\Notifications\InvestmentCreated;
use App\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\UserActivity;
use App\UserNotify;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class UserController extends Controller
{
    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'first_name',
        'last_name',
        'username',
        'country',
        'state',
        'city',
        'phone',
        'email',
        'is_admin',
        'password',
    ];

    /**
     * Show the admin home page.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = (new User())->newQuery();

        if ($request->input('search')) {
            $searchString = $request->get('search');
            $query = $query->where(function ($query) use ($searchString) {
                $query->where('id', 'LIKE', "%$searchString%");
                $query->orWhere('username', 'LIKE', "%$searchString%");
                $query->orWhere('first_name', 'LIKE', "%$searchString%");
                $query->orWhere('last_name', 'LIKE', "%$searchString%");
                $query->orWhere('phone', 'LIKE', "%$searchString%");
                $query->orWhere('country', 'LIKE', "%$searchString%");
                $query->orWhere('state', 'LIKE', "%$searchString%");
                $query->orWhere('city', 'LIKE', "%$searchString%");
            });
        }

        if ($request->input('filter_by')) {
            $filter = strtolower($request->input('filter_by'));
            switch ($filter) {
                case 'admins':
                    $query->where('is_admin', true);
                    break;
                case 'non-admins':
                    $query->where('is_admin', false);
                    break;
            }
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->sortable))
            $query = $query->orderBy($sort[0], $sort[1]);

     $userss = $query->get();
        $users = $query->paginate(10);
        

        $breadcrumb = [
            [
                'link' => route('admin.users'),
                'title' => 'Manage Users'
            ]
        ];

        return view('admin.users', [
            'breadcrumb' => $breadcrumb,
            'users' => $users,
            'userss' => $userss
        ]);
    }

    /**
     * Display user wallet.
     *
     * @param Request $request
     * @return Response
     */
    public function showUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
       // dd($user);

        $breadcrumb = [
            [
                'link' => route('admin.users'),
                'title' => 'Users'
            ],
            [
                'link' => route('admin.users.show', ['id' => $user->id]),
                'title' => 'User: ' . $user->username
            ]
        ];

        $totalDeposits = $user->deposits()->sum('amount');
        $activeDeposits = $user->deposits()->whereStatus(Deposit::STATUS_ACTIVE)->sum('amount');
        $lastDeposit = $user->deposits()->take(1)->sum('amount');

        $totalWithdrawals = $user->withdrawals()->where('status', '!=', Withdrawal::STATUS_CANCELED)->sum('amount');
        $pendingWithdrawals = $user->withdrawals()->whereStatus(Withdrawal::STATUS_PENDING)->sum('amount');
        $lastWithdrawal = $user->withdrawals()->where('status', '!=', Withdrawal::STATUS_CANCELED)->latest()->take(1)->sum('amount');

        return view('admin.show-user', [
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
     *  Edit profile.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin'
            ],
            [
                'link' => route('admin.users'),
                'title' => 'Manage Users'
            ],
            [
                'link' => route('admin.users.edit', ['id' => $user->id]),
                'title' => 'Edit User : ' . $user->name
            ]
        ];

        if (is_tab('password')) {
            return view('admin.user-edit.password', [
                'user' => $user,
                'breadcrumb' => $breadcrumb
            ]);
        }

        return view('admin.user-edit.profile', [
            'user' => $user,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Change the user profile details.
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws ValidationException
     */
    public function updateUser(Request $request, $id)
    {
      
        $user = User::findOrFail($id);
       // if(is_tab('password')) {
        //    $this->validate($request, [
               // 'password' => 'required|confirmed|min:6',
        //    ]);

        //    $data = [
        //        'password' => bcrypt($request->input('password')),
        //    ];
        //} else {
            $this->validate($request, [
                'first_name' => 'nullable',
                'last_name' => 'nullable',
                'country' => 'nullable',
                'city' => 'nullable',
                'state' => 'nullable',
                'phone' => 'nullable',
                'photo' => ['nullable', 'image:jpeg,jpg,png'],
                'email' => 'nullable',
            ]);

            $data['first_name'] = $request->input('first_name');
            $data['last_name'] = $request->input('last_name');
            $email = $request->input('email');

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
       // }

        tap($user)->update($data);
        Session::flash('msg', 'success');
        Session::flash('message', 'User updated Successfully');
        return redirect()
            ->back()
            ->with('success', 'User details updated successfully');
    }

    /**
     *  Rank user admin.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function rankUserAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();
        return redirect()->back()->with('message', 'User ranked successfully');
    }

    /**
     *  Un rank user admin.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function UnRankUserAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (strtolower($user->first_name) !== 'admin') {
            $user->is_admin = false;
            $user->save();
        } else {
            return redirect()->back()->with('message', 'Unable to un ranked user');
        }

        return redirect()->back()->with('message', 'User un ranked successfully');
    }

    /**
     *  Delete user.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroyUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (strtolower($user->first_name) !== 'admin') {
            $user->delete();
        } else {
            return redirect()->back()->with('message', 'Unable to delete user');
        }

        return redirect()->back()->with('message', 'User deleted successfully');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function sendBonus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $plans = Plan::with('package')->get();
        $packages = Package::with('plans')->get();

        $breadcrumb = [
            [
                'link' => route('admin.users'),
                'title' => 'Users'
            ],
            [
                'link' => route('admin.users.send_bonus', ['id' => $id]),
                'title' => 'Send Bonus'
            ]
        ];

        return view('admin.send-bonus', [
            'breadcrumb' => $breadcrumb,
            'user' => $user,
            'packages' => $packages,
            'plans' => $plans
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws ValidationException
     */
    public function doSendBonus(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'payment_method' => 'required',
            'plan' => 'nullable'
        ]);

        $user = User::findOrFail($id);
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');

        if (!empty($request->input('plan'))) {

            $this->validate($request, [
                'plan' => "exists:plans,id",
            ]);

            $plan = Plan::findOrfail($request->input('plan'));

            $this->validate($request, [
                'amount' => "required|numeric|min:{$plan->min_deposit}|max:{$plan->max_deposit}",
            ]);

            $expireDate = Carbon::now();

            switch ($plan->package->payment_period) {
                case Package::PERIOD_HOURLY:
                case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                    $expireDate->addHours($plan->package->duration);
                    break;
                case Package::PERIOD_DAILY:
                case Package::PERIOD_WEEKLY:
                case Package::PERIOD_MONTHLY:
                case Package::PERIOD_2_MONTHS:
                case Package::PERIOD_3_MONTHS:
                case Package::PERIOD_6_MONTHS:
                case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                    $expireDate->addDays($plan->package->duration);
            }

            $deposit = Deposit::create([
                'ref' => generate_reference(),
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'payment_method' => $paymentMethod,
                'amount' => $amount,
                'profit_rate' => $plan->profit_rate,
                'expires_at' => $expireDate,
                'duration' => $plan->package->duration,
                'payment_period' => $plan->package->payment_period
            ]);

            if ($request->input('notify')) {
                try {
                   $user->notify(new InvestmentCreated($deposit));
                } catch (Exception $exception) {

                }
            }
        } else {
            UserWallet::addBonus($user, $amount);
        }

        BonusHistory::create([
            'user_id' => $user->id,
            'amount' => $amount
        ]);

            $notify = new UserNotify;
            $notify->user_id = $user->id;
            $notify->message = 'Dear '.$user->username.','.' You have been credited a bonus amount of '.$amount.' USD'; 
            $notify->save();
                        
            Session::flash('msg', 'success');
            Session::flash('message', 'Bonus send Successfully'); 
            
        return redirect()->back()->with('success', 'Bonus transferred successfully');
    }



    /**
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function sendMessage(Request $request, $id)
    {
        $user = User::findOrFail($id);        

        $breadcrumb = [
            [
                'link' => route('admin.users'),
                'title' => 'Users'
            ],
            [
                'link' => route('admin.users.send_message', ['id' => $id]),
                'title' => 'Send Message'
            ]
        ];

        return view('admin.send-user-message', [
            'breadcrumb' => $breadcrumb,
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws ValidationException
     */
    public function doSendMessage(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'            
        ]);

        $subject = $request->input('subject');
        $text = $request->input('message');
        $user = User::findOrFail($id);
               // $notify = new UserNotify;
               // $notify->user_id = $user->id;
               // $notify->message = $text; 
               // $notify->save();
                $user->notify(new MessageUser($user, $text, $subject));
            Session::flash('alert', 'success');
            Session::flash('message', 'User messaged successfully');
          
        return redirect()->back()->with('success', 'User messaged successfully');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function sendUsersBonus(Request $request)
    {
        $plans = Plan::with('package')->get();
        $packages = Package::with('plans')->get();

        $breadcrumb = [
            [
                'link' => route('admin.users'),
                'title' => 'Users'
            ],
            [
                'link' => route('admin.users.send_users_bonus'),
                'title' => 'Send users Bonus'
            ]
        ];

        return view('admin.send-users-bonus', [
            'breadcrumb' => $breadcrumb,
            'plans' => $plans,
            'packages' => $packages
        ]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function doSendUsersBonus(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'payment_method' => 'required',
            'plan' => 'nullable',
            'recipients' => 'required'
        ]);

        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');
        $recipients = $request->input('recipients');

        switch ($recipients) {
            case 'deposited':
                $users = User::leftJoin('deposits', 'users.id', '=', 'deposits.user_id')
                    ->select('users.*')
                    ->where('deposits.id', '!=', null);
                break;
            case 'non-deposited':
                $users = User::leftJoin('deposits', 'users.id', '=', 'deposits.user_id')
                    ->select('users.*')
                    ->where('deposits.id', null);
                break;
            default:
                $users = User::all();
        }

        foreach ($users as $user) {
            if (!empty($request->input('plan'))) {

                $this->validate($request, [
                    'plan' => "exists:plans,id",
                ]);
                $plan = Plan::findOrfail($request->input('plan'));

                $this->validate($request, [
                    'amount' => "required|numeric|min:{$plan->min_deposit}|max:{$plan->max_deposit}",
                ]);

                $expireDate = Carbon::now();

                switch ($plan->package->payment_period) {
                    case Package::PERIOD_HOURLY:
                    case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                        $expireDate->addHours($plan->package->duration);
                        break;
                    case Package::PERIOD_DAILY:
                    case Package::PERIOD_WEEKLY:
                    case Package::PERIOD_MONTHLY:
                    case Package::PERIOD_2_MONTHS:
                    case Package::PERIOD_3_MONTHS:
                    case Package::PERIOD_6_MONTHS:
                    case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                        $expireDate->addDays($plan->package->duration);
                }

                $deposit = Deposit::create([
                    'ref' => generate_reference(),
                    'user_id' => $user->id,
                    'plan_id' => $plan->id,
                    'payment_method' => $paymentMethod,
                    'amount' => $amount,
                    'profit_rate' => $plan->profit_rate,
                    'expires_at' => $expireDate,
                    'duration' => $plan->package->duration,
                    'payment_period' => $plan->package->payment_period
                ]);

                if ($request->input('notify')) {
                    try {
                        $notify = new UserNotify;
                        $notify->user_id = $user->id;
                        $notify->message = 'Dear '.$user->username.','.' You have been credited a bonus amount of '.$amount.' USD'; 
                        $notify->save();
                        $user->notify(new InvestmentCreated($deposit));
                    } catch (Exception $exception) {

                    }
                }
            } else {
                UserWallet::addBonus($user, $amount);
            }

            BonusHistory::create([
                'user_id' => $user->id,
                'amount' => $amount
            ]);
        }
        Session::flash('alert', 'success');
        Session::flash('message', 'Bonus transferred successfully');
      
        return redirect()->back()->with('success', 'Bonus transferred successfully');
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function addUser(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('admin.users.add'),
                'title' => 'Add User'
            ]
        ];

        return view('admin.add-user', [
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|alpha|max:100|min:3',
            'last_name' => 'required|alpha|max:100|min:3',
            'username' => 'required|alpha_num|max:100|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'country' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'phone' => 'nullable',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone')
        ]);

        try {
            Mail::send(new \App\Mail\Register($user));
        } catch (\Exception $e) {

        }

        return redirect()->route('admin.users.show', ['id' => $user->id])->with('success', 'User added successfully');
    }

    public function activity($id){
        return view('admin.user-edit.activities')
                ->with('user', User::where('id', $id)->first())
                ->with('users', UserActivity::where('user_id', $id)->get());
    }

    public function pass($id){
        return view('admin.user-edit.password')
                ->with('user', User::where('id', $id)->first());
    }

    public function settings(Request $request, $id){
        $user = User::where('id', $id)->first();

        $this->validate($request, [
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

