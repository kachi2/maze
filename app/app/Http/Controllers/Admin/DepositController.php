<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\TradeController;
use App\Models\Deposit;
use App\Models\Package;
use App\Models\Plan;
use App\Models\UserWallet;
use App\Models\DepositTransaction;
use App\Models\PendingDeposit;
use App\Models\Referral;
use App\Notifications\DepositPaid;
use App\Notifications\InvestmentCreated;
use App\User;
use App\UserNotify;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Kevupton\LaravelCoinpayments\Events\Deposit\DepositCreated;

class DepositController extends Controller
{

    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'ref',
        'amount',
        'profit_rate',
        'user_id',
        'plan_id',
        'expires_at',
        'updated_at',
        'duration',
        'payment_period',
        'payment_method',
        'status'
    ];

    /**
     * Display a listing of the plan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Deposit::with('user');

        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('amount', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('profit_rate', 'LIKE', "%$searchString%");
                $query->orWhere('duration', 'LIKE', "%$searchString%");
                $query->orWhere('payment_method', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
                $query->orWhere('ref', 'LIKE', "%$searchString%");
            });
        }

        if ($request->input('filter_by')) {
            $filter = strtolower($request->input('filter_by'));
            switch ($filter) {
                case 'active':
                    $query->where('status', Deposit::STATUS_ACTIVE);
                    break;
                case 'completed':
                    $query->where('status', Deposit::STATUS_COMPLETED);
                    break;
                case 'canceled':
                    $query->where('status', Deposit::STATUS_CANCELED);
                    break;
            }
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->sortable))
            $query->orderBy($sort[0], $sort[1]);

        $deposits = $query->latest()->get();

        $breadcrumb = [
            [
                'link' => route('deposits'),
                'title' => 'Deposits'
            ]
        ];

        return view('admin.deposits', [
            'deposits' => $deposits,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Delete user.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroyDeposit(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $user = $deposit->user;
        $amount = $deposit->amount;
        $status = $deposit->status;

        $deleted = $deposit->delete();

        if ($deleted && $status == 0) {
            UserWallet::addAmount($user, $amount);
        }

        Session::flash('msg', 'success');
        Session::flash('message', 'Deposit deleted successfully'); 
        return redirect()
            ->back()
            
            ->with('success', 'Deposit deleted successfully');
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function addDeposit(Request $request, $id = null)
    {
        $plans = Plan::with('package')->get();
        $packages = Package::with('plans')->get();    

        $breadcrumb = [
            [
                'link' => route('admin.deposits'),
                'title' => 'Deposits'
            ],
            [
                'link' => route('admin.deposits.add'),
                'title' => 'Add Deposit'
            ]
        ];

        if ($id == null) {
            return view('admin.select-plan', [
                'breadcrumb' => $breadcrumb,
                'plans' => $plans,
                'packages' => $packages,
            ]);
        }

        $plan = Plan::findOrFail($id);


        return view('admin.add-deposit', [
            'breadcrumb' => $breadcrumb,
            'plan' => $plan,
            'packages' => $packages,
            'plans' => $plans,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeDeposit(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $this->validate($request, [
            'amount' => "required|numeric|min:{$plan->min_deposit}|max:{$plan->max_deposit}",
            'payment_method' => 'required',
            'email' => 'required|email',
            'user_name' => 'required|max:200',
        ]);

        $amount = $request->input('amount');
        $email = $request->input('email');
        $paymentMethod = $request->input('payment_method');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $username = substr($email, 0, strpos($email, '@'));
            $name = explode(' ', $request->input('user_name'));
            $firstName = $name[0];
            $lastName = isset($name[1]) ? $name[1] : '';
            if (User::whereUsername($username)->exists()) {
                $rand = rand(3, 3);
                $username .= ' ' . $rand;
            }
            $user = new  User([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $email,
                'password' => bcrypt(generate_token()),
            ]);

            $user->save();
        }

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
        
       
        $notify = new UserNotify;
            $notify->user_id = $deposit->user->id;
            $notify->message = 'Dear '.$deposit->user->username.','.' Deposit completed Successfully, thanks for trusting us'; 
            $notify->save();
        Session::flash('msg', 'success');
        Session::flash('message', 'Deposit Completed Successfully'); 
        $user->notify(new InvestmentCreated($deposit));
       
        return redirect()->back()->with('success', 'Deposit added successfully');
    }

    public function approveIndex(){
        return view('admin.payment_request')
                ->with('payment_request', PendingDeposit::latest()->paginate(70));
    }

    public function depositApprove($id){
        $id = decrypt($id);
        $deposit = PendingDeposit::whereId($id)->first();
        //dd($deposit);
        $update =  PendingDeposit::whereId($id)
                    ->update([
                        'status' => 1,
                    ]);
            
        if($update){
           
            $expireDate = Carbon::now();

        switch ($deposit->payment_period) {
            case Package::PERIOD_HOURLY:
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                $expireDate->addHours($deposit->duration);
                break;
            case Package::PERIOD_DAILY:
            case Package::PERIOD_WEEKLY:
            case Package::PERIOD_MONTHLY:
            case Package::PERIOD_2_MONTHS:
            case Package::PERIOD_3_MONTHS:
            case Package::PERIOD_6_MONTHS:
            case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                $expireDate->addDays($deposit->duration);
        }
        $deposit = Deposit::create([
            'ref' => $deposit->ref,
            'user_id' => $deposit->user_id,
            'plan_id' => $deposit->plan_id,
            'payment_method' => $deposit->payment_method,
            'amount' => $deposit->amount,
            'profit_rate' => $deposit->profit_rate,
            'expires_at' => $expireDate,
            'duration' => $deposit->duration,
            'payment_period' => $deposit->payment_period
        ]);       
        
        $ur = Referral::where('user_id', $deposit->user->id)->first();
        $bonus = ($deposit->amount * 10)/100;
        if($ur){
        $ref_wallet = UserWallet::where('user_id', $ur->referrer_id)->first();
        $update_ref_wallet = UserWallet::where('user_id', $ur->referrer_id)
                    ->update(['referrals' => $bonus + $ref_wallet->referrals]);
        }
            $notify = new UserNotify;
            $notify->user_id = $deposit->user->id;
            $notify->message = 'Dear '.$deposit->user->username.','.' Your payment has been approved successfully, thanks for trusting us'; 
            $notify->save();
       // $deposit->user->notify(new InvestmentCreated($deposit));
           Session::flash('msg', 'success');
        Session::flash('message', 'Deposit Approved Successfully'); 
     
        return redirect()->back()->with('success', 'Payment Approve Successfully');
        }

    }

    /**
     *  Mark the withdraw paid.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function markExpired(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        if (!$deposit->has_expired) {
            $deposit->expires_at = now();
            $deposit->status = Deposit::STATUS_COMPLETED;
            if (!$deposit->save()) {
                return redirect()
                    ->back()
                    ->with('error', 'Unable to mark the deposit expired');
            }
        }

            $notify = new UserNotify;
            $notify->user_id = $deposit->user->id;
            $notify->message = 'Dear '.$deposit->user->username.','.' Your Deposit has been marked expired, if you are not sure about contact Us'; 
            $notify->save();
        return redirect()
            ->back()
            ->with('success', 'Deposit marked expired successfully');
    }
    
     public function markCompleted(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $update = Deposit::where('id', $deposit->id)->update(['status' => 1]);
            if(!$update){
                Session::flash('msg', 'error');
                Session::flash('message', 'Unable to mark the investment expired'); 
                return redirect()->back();
            }
           
            $notify = new UserNotify;
            $notify->user_id = $deposit->user->id;
            $notify->message = 'Dear '.$deposit->user->username.','.' Your investment is completed, and funds transfered to your wallet'; 
            $notify->save();
            Session::flash('msg', 'success');
            Session::flash('message', 'Investment marked Completed successfully');
        return redirect()->back();
    }
}
