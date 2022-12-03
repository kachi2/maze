<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Deposit;
use App\Models\Package;
use App\Models\PendingDeposit;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;
use App\PayoutsHistory;
use App\Models\UserWallet;
use App\Modules\PerfectMoney;
use App\Notifications\InvestmentCreated;
use App\User;
use Exception;
use App\Models\Payout;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\PlanProfit;
use App\WalletAddress;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Kevupton\LaravelCoinpayments\Facades\Coinpayments;
use Kevupton\LaravelCoinpayments\Models\Transaction;

class DepositController extends Controller
{

    const ITEM_CURRENCY = 'USD';
    const ITEM_TAX_RATE = 0.05;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the plan.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $query = Deposit::whereUserId($request->user()->id);

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

        $deposits = $query->latest()->Paginate(20);

        $breadcrumb = [
            [
                'link' => route('deposits'),
                'title' => 'Deposits'
            ]
        ];

        return view('deposit.deposits', [
            'deposits' => $deposits,
            'pending' => PendingDeposit::where('user_id', auth()->user()->id)->get(),
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display a listing of the plan.
     *
     * @param Request $request
     * @return Factory|View
     */

    public function PayoutsDetails($id = null){
        $payouts = Payout::where('deposit_id', decrypt($id))->latest()->simplePaginate(10);
        $plan = Deposit::where('id', decrypt($id))->first();
        $sum = Payout::where('deposit_id', decrypt($id))->sum('amount');
        return view('deposit.payouts', 
        [
            'payouts'=>$payouts,
            'plan' => $plan,
            'sum' => $sum
        ]);

     }
    public function showTransactions(Request $request)
    {
        $query = PendingDeposit::whereUserId($request->user()->id);

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
                case 'pending':
                    $query->where('status', PendingDeposit::STATUS_PENDING);
                    break;
                case 'verified':
                    $query->where('status', PendingDeposit::STATUS_VERIFIED);
                    break;
                case 'canceled':
                    $query->where('status', PendingDeposit::STATUS_CANCELED);
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
            ],
            [
                'link' => route('deposits.transactions'),
                'title' => 'Transactions'
            ]
        ];

        return view('deposit.transactions', [
            'deposits' => $deposits,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display a listing of the deposit.
     *
     * @param $ref
     * @return Factory|View
     */
    public function show($ref)
    {
        $deposit = Deposit::whereRef($ref)->firstOrFail();

        $breadcrumb = [
            [
                'link' => route('deposits'),
                'title' => 'Deposits'
            ],
            [
                'link' => route('deposit', ['ref', $ref]),
                'title' => 'Deposit: ' . $ref
            ]
        ];

        return view('deposit.show-deposit', [
            'breadcrumb' => $breadcrumb,
            'deposit' => $deposit,
        ]);
    }

    /**
     * Display a listing of the plan.
     *
     * @param $ref
     * @return Factory|View
     */
    public function showTransaction($ref)
    {
        $deposit = PendingDeposit::where('ref', $ref)->firstOrFail();

        if ($deposit->payment_method == PendingDeposit::PAYMENT_METHOD_BTC) {
            return $this->showBlockChainTransaction($deposit->ref, $deposit);
        } elseif ($deposit->payment_method != PendingDeposit::PAYMENT_METHOD_PM) {
            $transaction = Transaction::where('invoice', $ref)->firstOrFail();
            return $this->showCoinpaymentTransaction($transaction->txn_id, $transaction);
        }

        $breadcrumb = [
            [
                'link' => route('deposits'),
                'title' => 'Deposits'
            ],
            [
                'link' => route('deposits.transactions'),
                'title' => 'Invest'
            ],
            [
                'link' => $deposit->url,
                'title' => 'Transaction: ' . $ref
            ]
        ];

        $perfectMoney = new PerfectMoney();

        return view('deposit.perfectmoney-proceed', [
            'proceed_form' => $perfectMoney->makePayment([
                'PAYMENT_AMOUNT' => $deposit->verifying_amount,
                'PAYMENT_ID' => $deposit->id
            ]),
            'deposit' => $deposit,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display a listing of the plan.
     *
     * @param $ref
     * @param PendingDeposit|null $deposit
     * @return Factory|View
     */
    public function showBlockChainTransaction($ref, PendingDeposit $deposit = null)
    {
        if (!$deposit) {
            $deposit = PendingDeposit::whereRef($ref)->firstOrFail();
        }
        $breadcrumb = [
            [
                'link' => route('deposits'),
                'title' => 'Deposits'
            ],
            [
                'link' => route('deposits.blockchain_transaction', ['ref', $ref]),
                'title' => 'Deposit Transaction : ' . $deposit->ref
            ]
        ];

        $plan = $deposit->plan;
        
        $qrcode = 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:' . $deposit->token . '?amount=' . $deposit->verifying_amount;
            
        return view('deposit.show-blockchain-transaction-details', [
            'breadcrumb' => $breadcrumb,
            'deposit' => $deposit,
            'qrcode' => $qrcode,
            'plan' => $plan
        ]);
    }

    /**
     * Display a listing of the plan.
     *
     * @param $id
     * @param Transaction $transaction
     * @return Factory|View
     */
    public function showCoinpaymentTransaction($id = null, $ref=null)
    {
        $id = decrypt($id);
     
        $plans = Plan::with('package')->get();
        $balance = auth()->user()->wallet->amount;
        $bonus = auth()->user()->wallet->bonus;
        $investment = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->latest()->simplePaginate(5);
        $sum = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->sum('amount');
        $total = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->where('status', 0)->sum('amount');
        $completed = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->where('status', 1)->get();
        $deposited = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->where('payment_method', '!=','wallet')->get();
        $payouts = PlanProfit::where(['user_id'=>auth()->user()->id, 'plan_id' => $id,])->sum('balance');
       
        $pending = PendingDeposit::where('ref', $ref)->first();
        $wallet = WalletAddress::where('name', $pending->currency2)->first();

        $plan = Plan::findOrFail($id);
        return view('deposit.invest', [
          //  'breadcrumb' => $breadcrumb,
            'plan' => $plan,
            'plans' => $plans,
            'balance' => $balance,
            'bonus' => $bonus,
            'wallet' => $wallet,
            'pending' => $pending,
            'investment' => $investment,
            'total' => $total,
            'deposited' => $deposited,
            'payouts' => $payouts,
            'sum' => $sum, 
            'completed' => $completed
        ]);
    

    }

    /**
     * Update payouts.
     *
     * @param Request $request
     * @return Response
     */
    public function updatePayouts(Request $request)
    {
        $deposits = Deposit::whereStatus(Deposit::STATUS_ACTIVE);
    }

    /**
     * Display a listing of the plan.
     *
     * @param Request $request
     * @param $id
     * @return string
     */
     
     public function saveHashNo(Request $request){
         $deposit = PendingDeposit::where('ref', $request->ref)->first()
                    ->update(['hash_no' => $request->hash]);
            if($deposit){
                    Session::flash('alert', 'success');
                    Session::flash('done', 'readonly');
                    Session::flash('message', 'Your request is pending, Your deposit will be approved once confirmed');
                    return redirect()->route('web.deposits');
         }else{
             return back();
         }
                    
     }

     public function TransferPayouts(Request $request, $id){

        $payouts = PlanProfit::where(['user_id' => auth_user()->id, 'plan_id' => decrypt($id)])->first();
      //  dd($payouts);
        if($request->amount < 0){
            return back();
        }
        if($payouts->balance < $request->amount){

            //return balance is too low for this service
        }
        $balance = $payouts->balance;
        $newBalance = $balance - $request->amounts;
        PlanProfit::where(['user_id' => auth_user()->id, 'plan_id' => decrypt($id)])
                    ->update([
                        'prev_balance' => $balance,
                        'balance' => $newBalance
                    ]);
                    PayoutsHistory::create([
                        'ref' => generate_reference(),
                        'user_id' => auth_user()->id,
                        'amount' => $request->amounts,
                        'prev_balance' => $balance,
                        'avail_balance' => $newBalance
                    ]);
                        UserWallet::addAmount(auth_user(), $request->amounts);
                        Session::flash('alert', 'success');
                        Session::flash('message', 'Payout transfered to wallet successfully');
                        return back();
             }
        
 public function PayoutsTransfer(){
                return view('deposit.transfers')
                ->with('payouts', PayoutsHistory::where('user_id', auth_user()->id)->latest()->get());
     }
    public function invest(Request $request, $id = null)
    {
        $id = decrypt($id);
        $plans = Plan::with('package')->get();
        $balance = $request->user()->wallet->amount;
        $bonus = $request->user()->wallet->bonus;
        $investment = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->latest()->simplePaginate(8);
        $sum = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->sum('amount');
        $total = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->where('status', 0)->sum('amount');
        $completed = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->where('status', 1)->get();
        $deposited = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->where('payment_method', '!=','wallet')->get();
        $payouts = PlanProfit::where(['user_id'=>$request->user()->id, 'plan_id' => $id,])->sum('balance');
        $breadcrumb = [
            [
                'link' => route('deposits'),
                'title' => 'Deposits'
            ],
            [
                'link' => route('deposits.invest', ['id' => $id]),
                'title' => 'Invest'
            ]
        ];
        $plan = Plan::findOrFail($id);
        return view('deposit.invest', [
            'breadcrumb' => $breadcrumb,
            'plan' => $plan,
            'plans' => $plans,
            'balance' => $balance,
            'bonus' => $bonus,
            'investment' => $investment,
            'total' => $total,
            'deposited' => $deposited,
            'payouts' => $payouts,
            'sum' => $sum, 
            'completed' => $completed
        ]);
    }

    /**
     * Display a listing of the plan.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function doInvest(Request $request, $id)
    {
        $id = decrypt($id);
        $plan = Plan::findOrFail($id);
        $validte = validator::make($request->all(), [
            'amount' => "required|numeric",
            'payment_method' => 'required'
        ]);
        if($validte->fails()){
            \Session::flash('msg', 'error');
            \Session::flash('message', 'Some fields are missing'); 
             return  redirect()->back()->withInput($request->all())->withErrors($validte);
        }
 
        
    if($plan->min_deposit > $request->amount){
        //  Session::flash('msg', 'error');
        //  Session::flash('message', 'Amount must be greater than $'.$plan->min_deposit); 
         $msg = 'Amount must be greater than $'.$plan->min_deposit;
         $data = [
            'msg' => $msg,
            'alert' => 'error'
        ];
        \Session::flash('msg', 'error');
        \Session::flash('message', 'Amount must be greater than $'.$plan->min_deposit); 
         return  redirect()->back();
    }
    if($plan->max_deposit <  $request->amount){
        
        //  Session::flash('msg', 'error');
        //       Session::flash('message', 'Amount must be less than $'.$plan->max_deposit); 
        $msg = 'Amount must be less than $'.$plan->max_deposit;
        $data = [
           'msg' => $msg,
           'alert' => 'error'
       ];
       \Session::flash('msg', 'error');
        \Session::flash('message', 'Amount must be less than $'.$plan->max_deposit); 
         return  redirect()->back();
    }
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');
        $ref = generate_reference();
        switch ($paymentMethod) {
            case 'wallet':
                return $this->investFromWallet($request, $plan, $amount, $ref);
                break;
            case Deposit::PAYMENT_METHOD_BTC:
            case Deposit::PAYMENT_METHOD_DGB:
            case Deposit::PAYMENT_METHOD_ETH:
            case Deposit::PAYMENT_METHOD_LTC:
            case Deposit::PAYMENT_METHOD_BCH:
                
               return  $this->investFromCripto($request, $plan, $amount, $paymentMethod, $ref);
            case Deposit::PAYMENT_METHOD_PM:
                return $this->investFromPerfectMoney($request, $plan, $amount, $ref);
        }
    }

    private function investFromWallet(Request $request, Plan $plans, $amount, $ref)
    {
        $userWallet = $request->user()->wallet;
        if ($userWallet->total_amount < $amount) {
              Session::flash('msg', 'error');
              Session::flash('message', 'You dont have enough fund to invest on this plan'); 
            return redirect()->back();
        }
        UserWallet::reduceAmount($request->user(), $request->input('amount'));
        try {
            $deposit = $this->saveDeposit($ref, $plans, $request->user(), $amount, Deposit::PAYMENT_METHOD_WALLET);
        } catch (Exception $e) {
            return redirect()->route('home')->withInput()->with('error', 'Unable to invest on plan');
        }
        try {
            $request->user()->notify(new InvestmentCreated($deposit)); 
        } catch (Exception $exception) {

        }
        Session::flash('msg', 'success');
        Session::flash('message', 'Investment Initiated successfully'); 
        return redirect()->back();
    }

    protected function investFromCripto(Request $request, Plan $plan, $amount, $currency, $ref)
    {
        $coins = $currency;
        switch ($coins){
            case "BTC":
            $coins = "bitcoin";
            break;
            case "ETH":
            $coins = "ethereum";
            break;
            case "LTC":
            $coins = "litecoin";
            break;   
            case "USDT":
            $coins = "tether";
            break;
        }
        try {
            $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.coingecko.com/api/v3/simple/price?ids='.$coins.'&vs_currencies=usd');
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true); 
        $se = curl_exec($cURLConnection);
        curl_close($cURLConnection);  
        $resp = json_decode($se, true);
        $amount2 = $amount / $resp[$coins]['usd'];
      $transaction = $this->savePendingDeposit($ref, $plan, $request->user(), $amount, $amount2, $currency);    
        $wallet = WalletAddress::where('name', $currency)->first();
        \Session::flash('msg', 'success');
       \Session::flash('message', 'Investment Initiated Successfully'); 
        return view('deposit.payment')->with('wallet', $wallet)->with('transaction', $transaction)
        ->with('plan', $plan);
        } catch (Exception $exception) {
        Session::flash('msg', 'error');
        Session::flash('message', 'An error occured, try again'); 
            return redirect()->back()->withInput();
        }
    }

  

    /**
     * @param string $ref
     * @param Plan $plan
     * @param User $user
     * @param $amount
     * @param string $paymentMethod
     * @return Deposit|Model
     */
    protected function saveDeposit($ref, Plan $plan, User $user, $amount, $paymentMethod) {
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

        return Deposit::create([
            'ref' => $ref,
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'payment_method' => $paymentMethod,
            'amount' => $amount,
            'profit_rate' => $plan->profit_rate,
            'expires_at' => $expireDate,
            'duration' => $plan->package->duration,
            'payment_period' => $plan->package->payment_period
        ]);
    }

    /**
     * @param string $ref
     * @param Plan $plan
     * @param User $user
     * @param $amount
     * @param $fee
     * @param $verifying_amount
     * @param $paymentMethod
     * @return PendingDeposit|Model
     */
    protected function savePendingDeposit($ref, Plan $plan, User $user, $amount, $amount2, $paymentMethod) {
        return PendingDeposit::create([
            'ref' => $ref,
            'user_id' => $user->id,
            'fee' => 0,
            'amount2'=> $amount2,
            'amount1' => $amount,
            'currency1' => 'USD',
            'currency2' => $paymentMethod,
            'verifying_amount' => $amount,
            'plan_id' => $plan->id,
            'amount' => $amount,
            'profit_rate' => $plan->profit_rate,
            'payment_method' => $paymentMethod,
            'duration' => $plan->package->duration,
            'payment_period' => $plan->package->payment_period
        ]);
    }

    protected function investFromPerfectMoney(Request $request, Plan $plan, $amount, $ref)
    {
    //     $fee = $amount * self::ITEM_TAX_RATE/ 100;
    //     $cost = $amount + $fee;
    //    // $deposit = $this->savePendingDeposit($ref, $plan, $request->user(), $amount, $fee,  $cost, Deposit::PAYMENT_METHOD_PM);
    //     $perfectMoney = new PerfectMoney();

    //     $breadcrumb = [
    //         [
    //             'link' => route('deposits'),
    //             'title' => 'Deposits'
    //         ],
    //         [
    //             'link' => route('deposits.invest', ['id' => $plan->id]),
    //             'title' => 'Invest'
    //         ]
    //     ];

    //     return view('deposit.perfectmoney-proceed', [
    //         'proceed_form' => $perfectMoney->makePayment([
    //             'PAYMENT_AMOUNT' => $cost,
    //             'PAYMENT_ID' => $deposit->id
    //         ]),
    //         'deposit' => $deposit,
    //         'breadcrumb' => $breadcrumb
    //     ]);
    // 
}
}
