<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers\Admin;


use App\Modules\PerfectMoney;
use App\Notifications\WithdrawalCanceled;
use App\User;
use Exception;
use App\Models\UserWallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\WithdrawalProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Kevupton\LaravelCoinpayments\Facades\Coinpayments;

class WithdrawalController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Withdrawal::with('user');

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

        $withdrawals = $query->latest()->paginate(20000);

        $breadcrumb = [
            [
                'link' => route('admin.withdrawals'),
                'title' => 'Manage Withdrawals'
            ]
        ];

        return view('admin.withdrawals', [
            'withdrawals' => $withdrawals,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Mark the withdraw paid.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function markAsPaid(Request $request, $id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        if (!$withdraw->paid) {
            try {
                if ($withdraw->payment_method == Withdrawal::PAYMENT_METHOD_PM) {
                    $perfectMoney = new PerfectMoney();
                    $perfectMoney->sendMoney($withdraw->wallet_address, $withdraw->amount - ($withdraw->amount * 1 / 100));
                } else {
                    $response = Coinpayments::createWithdrawal($withdraw->amount - ($withdraw->amount * 1 / 100), $withdraw->payment_method, "USD", $withdraw->wallet_address, true);

                    if ($response) {
                        $withdraw->status = Withdrawal::STATUS_PAID;
                        $withdraw->save();
                    } else {
                        return redirect()
                            ->back()
                            ->with('error', 'Unable to mark the withdrawal paid');
                    }
                }
            } catch (Exception $exception) {
                Log::error($exception);
                return redirect()
                    ->back()
                    ->with('error', $exception->getMessage());
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Withdrawal marked paid successfully');
    }
    
    public function markPaid(Request $request, $id)
    {
        $withdraw = Withdrawal::findOrFail($id);
        if (!$withdraw->paid) {
                $withdraw->status = Withdrawal::STATUS_PAID;
                $withdraw->save();

                try { 
                    $withdraw->user->notify(new WithdrawalProcessed($withdraw));
                } catch (Exception $exception) {

                }

            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Unable to mark the withdrawal paid');
            }
    

        return redirect()
            ->back()
            ->with('success', 'Withdrawal marked paid successfully');
    }

    /**
     *  Delete user.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroyWithdrawal(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $user = $withdrawal->user;
        $amount = $withdrawal->amount;
        $status = $withdrawal->status;

        $deleted = $withdrawal->delete();

        if ($deleted && $status == 0) {
            UserWallet::addAmount($user, $amount);
        }

        return redirect()
            ->back()
            ->with('success', 'Withdrawal deleted successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addWithdrawal(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('admin.withdrawals'),
                'title' => 'Withdrawals'
            ],
            [
                'link' => route('admin.withdrawals.add'),
                'title' => 'Add Withdrawals'
            ]
        ];

        $totalWithdrawals = Withdrawal::sum('amount');
        $pendingWithdrawals = Withdrawal::whereStatus(Withdrawal::STATUS_PENDING)->sum('amount');
        $canceledWithdrawals = Withdrawal::whereStatus(Withdrawal::STATUS_CANCELED)->sum('amount');


        return view('admin.add-withdrawal', [
            'breadcrumb' => $breadcrumb,
            'total_withdrawals' => $totalWithdrawals,
            'pending_withdrawals' => $pendingWithdrawals,
            'canceled_withdrawals' => $canceledWithdrawals
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function storeWithdrawal(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'email' => 'required|email',
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
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->validate($request, [
                'user_name' => 'required|max:200',
            ]);

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

        $withdrawal = Withdrawal::create([
            'ref' => generate_reference(),
            'user_id' => $user->id,
            'amount' => $amount,
            'wallet_address' => $walletAddress,
            'payment_method' => $paymentMethod,
            'status' => Withdrawal::STATUS_PAID
        ]);

        $user->notify(new WithdrawalProcessed($withdrawal));

        return redirect()->back()->with('success', 'Withdrawal added successfully');
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
        $withdrawal = Withdrawal::findOrFail($id);
        if ($withdrawal->status == Withdrawal::STATUS_PENDING) {
            $withdrawal->status = Withdrawal::STATUS_CANCELED;
            if ($withdrawal->save()) {
                UserWallet::addAmount($withdrawal->user, $withdrawal->amount);
                try {
                    $withdrawal->user->notify(new WithdrawalCanceled($withdrawal));
                } catch (Exception $exception) {

                }
                return redirect()
                    ->back()->with('success', 'Withdrawal request canceled successfully.');
            }
        }

        return redirect()
            ->back()->with('error', 'Unable to cancel the withdrawal request');
    }
    
    
}
