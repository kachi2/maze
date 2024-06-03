<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;


use App\Models\UserWallet;
use App\Models\Withdrawal;
use App\Modules\BlockChain;
use App\Modules\PerfectMoney;
use Illuminate\Support\Facades\Session;
use App\Notifications\WithdrawalCanceled;
use App\Notifications\WithdrawalRequested;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use SweetAlert;
use App\WithdrawalAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Kevupton\LaravelCoinpayments\Facades\Coinpayments;

class WithdrawController extends Controller
{

    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'id',
        'currency',
        'amount',
        'paid',
        'status',
        'created_at'
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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $query = Withdrawal::whereUserId($request->user()->id);

        if ($request->input('search')) {
            $query->where(function (Builder $query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('amount', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('payment_method', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
                $query->orWhere('ref', 'LIKE', "%$searchString%");
            });
        }

        if ($request->input('filter_by')) {
            $filter = strtolower($request->input('filter_by'));
            switch ($filter) {
                case 'pending':
                    $query->where('status', Withdrawal::STATUS_PENDING);
                    break;
                case 'processed':
                    $query->where('status', Withdrawal::STATUS_PAID);
                    break;
                case 'canceled':
                    $query->where('status', Withdrawal::STATUS_CANCELED);
                    break;
            }
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->sortable))
            $query = $query->orderBy($sort[0], $sort[1]);

        $withdrawals = $query->paginate(20);

        $breadcrumb = [
            [
                'link' => route('web.withdrawals'),
                'title' => 'Withdrawals'
            ]
        ];
   

        return view('withdrawal.withdrawals', [
            'withdrawals' => $withdrawals,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function request(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('web.withdrawals'),
                'title' => 'Withdrawals'
            ],
            [
                'link' => route('web.withdrawals.request'),
                'title' => 'Request Withdrawal'
            ]
        ];

        $balance = $request->user()->wallet->amount;
        $pendingWithdrawals = Withdrawal::whereUserId(auth_user()->id)->where('status', Withdrawal::STATUS_PENDING)->sum('amount');

        return view('withdrawal.request-withdrawal', [
            'breadcrumb' => $breadcrumb,
            'balance' => $balance,
            'pending_withdrawals' => $pendingWithdrawals
        ]);
    }

    /**
     * Store the withdra3wal request.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $wallet = $request->user()->wallet->amount;

        if(!isset($request->payment_method)){
            Session::flash('alerts', 'Please add payment method');
            return back()->withInput($request->all());
        }
        $this->validate($request, [
            'amount' => "required|numeric|min:10|max:{$wallet}",
        ]);
        
        $wallet = WithdrawalAccount::where('id', decrypt($request->payment_method))->first();
        
            $walletAddress = $wallet->address;
            $paymentMethod = $wallet->currency;
            $amount = $request->input('amount');

        $withdrawal = Withdrawal::create([
            'ref' => generate_reference(),
            'user_id' => $request->user()->id,
            'amount' => $amount,
            'wallet_address' => $walletAddress,
            'payment_method' => $paymentMethod
        ]);

        UserWallet::reducePayoutAmount($request->user(), $amount);
      
        try {
            $withdrawal->user->notify(new WithdrawalRequested($withdrawal));
        } catch (Exception $exception) {

        }
        Session::flash('alert', 'success');
        Session::flash('message', 'Withdrawal request sent successfully.');
     //   Alert::html('Html Title', 'Html Code', 'Type');
        return back()
            ->with('success', 'Withdrawal request successfully submitted.');
    }

    /**
     * Cancel the withdrawal request.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function cancel(Request $request, $id)
    {
        $withdrawal = Withdrawal::whereUserId($request->user()->id)->where('id', $id)->firstOrFail();
        if ($withdrawal->status == Withdrawal::STATUS_PENDING) {
            $withdrawal->status = Withdrawal::STATUS_CANCELED;
            if($withdrawal->save()) {
                UserWallet::addAmount($withdrawal->user, $withdrawal->amount);
                try {
                    $withdrawal->user->notify(new WithdrawalCanceled($withdrawal));
                } catch (Exception $exception) {
                }
                Session::flash('msg', 'success');
                Session::flash('message', 'Withdrawal request canceled successfully.');
                return redirect()
                    ->back()->with('success', 'Withdrawal request canceled successfully.');
            }
        }

        return redirect()
            ->back()->with('error', 'Unable to cancel the withdrawal request');
    }
    
    public function AddAccount(){
            return view('withdrawal.accounts')
            ->with('Waccount', WithdrawalAccount::where('user_id', auth_user()->id)->get());
    }
    public function addWithdrawals(Request $req){
           $this->validate($req, [
              'account_type' => 'required',
              'address' => 'required',
              'payment_method' => 'required'
          ]);
  
          $withdraw = new WithdrawalAccount;
          $withdraw->user_id = auth_user()->id;
          $withdraw->type = $req->account_type;
          $withdraw->address = $req->address;
          $withdraw->currency = $req->payment_method;
  
          if($withdraw->save()){
              Session::flash('alert', 'success');
              Session::flash('message', 'Withdrawal Account Added successfully.');
              return back();
          };
  
          return back();
      }
  
      public function DeleteAddress($id){
  
          $adr = WithdrawalAccount::where('id', decrypt($id))->first();
          if($adr){
              $adr->delete();
              Session::flash('alerts', 'success');
              Session::flash('msg', 'Withdrawal Account Deleted Successfully.');
              return back();   
          }
          return back();
      }
}
