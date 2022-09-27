<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers;


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
Use Alert;
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
        $pending = Withdrawal::where(['user_id' =>auth()->user()->id, 'status' => 0])->sum('amount');
        $success = Withdrawal::where(['user_id' =>auth()->user()->id, 'status' => 1])->sum('amount');

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

        $withdrawals = $query->latest()->paginate(5);

        $breadcrumb = [
            [
                'link' => route('withdrawals'),
                'title' => 'Withdrawals'
            ]
        ];

        return view('mobile.withdrawals', [
            'withdrawals' => $withdrawals,
            'breadcrumb' => $breadcrumb,
            'pending' => $pending,
            'success' => $success,
            'total' => $query->sum('amount')
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
                'link' => route('withdrawals'),
                'title' => 'Withdrawals'
            ],
            [
                'link' => route('withdrawals.request'),
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

        $this->validate($request, [
            'amount' => "required|numeric|min:10|max:{$wallet}",
        ]);

        if (is_tab('perfect-money')) {
            $this->validate($request, [
                'pm_account_id' => "required"
            ]);
            $walletAddress = $request->input('pm_account_id');
            $paymentMethod = Withdrawal::PAYMENT_METHOD_PM;
        } else {
            $this->validate($request, [
                'wallet_address' => "required"
            ]);
            $walletAddress = $request->input('wallet_address');
            $paymentMethod = $request->input('payment_method');
        }

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

        if (config('app.automatic_withdrawal')) {
            if ($withdrawal->payment_method == Withdrawal::PAYMENT_METHOD_PM) {
                $perfectMoney = new PerfectMoney();
                $res = $perfectMoney->createWithdrawal($withdrawal->amount, $withdrawal->wallet_address);
                if ($res['status'] == 'success') {
                    $withdrawal->status = Withdrawal::STATUS_PAID;
                    $withdrawal->save();
                } else {
                    Log::error($res['message']);
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Ann error occurred');
                }
            } elseif ($withdrawal->payment_method == $paymentMethod) {
                $response = Coinpayments::createWithdrawal($withdrawal->amount - ($withdrawal->amount * 1 / 100), $withdrawal->payment_method, $withdrawal->payment_method, $withdrawal->wallet_address, true);
                if ($response) {
                    $withdrawal->status = Withdrawal::STATUS_PAID;
                    $withdrawal->save();
                } else {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'An error occurred');
                }
            }
        }
        Session::flash('msg', 'success');
        Session::flash('message', 'Withdrawal request sent successfully.');
     //   Alert::html('Html Title', 'Html Code', 'Type');
        return redirect()
            ->route('withdrawals')
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

    public function Details($id){
        return view('mobile.tranxdetails', [
            'withdrawal' => Withdrawal::where('id', decrypt($id))->first()
        ]);
    }
    
    
}
