<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Package;
use App\Models\Referral;
use App\Models\UserWallet;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use App\Models\PendingDeposit;
use App\WalletDeposit;
use App\PlanProfit;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\User;

use App\UserActivity;
use Kevupton\LaravelCoinpayments\Models\Withdrawal as ModelsWithdrawal;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return Renderable
     */

     public function Markets(){
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page=1&sparkline=false');
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true); 
        $se = curl_exec($cURLConnection);
        curl_close($cURLConnection);  
        $resp = json_decode($se, true);
        if(empty($resp)){
            $resp = [];
        }
         return view('mobile.markets', [
             'coins' => $resp,
         ]);
     }
    public function index()
    {
        $chck = auth_user()->is_admin;
        if($chck){
            return redirect('/admin');
        }
        $user = auth_user();
        $packages = Package::with('plans')->get();
        $totalDeposits = Deposit::whereUserId($user->id)->sum('amount');
        $totalInvest = Deposit::whereUserId($user->id)->where('payment_method', '!=', 'WALLET')->where('status', 1)->sum('amount');
        $totalInvest2 = WalletDeposit::whereUserId($user->id)->where('payment_method', '!=', 'WALLET')->where('status', 1)->sum('amount');
        $activeDeposits = Deposit::whereUserId($user->id)->whereStatus(Deposit::STATUS_ACTIVE)->sum('amount');
        $lastDeposit = Deposit::whereUserId($user->id)->latest()->take(1)->sum('amount');
        $data['withdrawals'] = Withdrawal::where(['status' => '1', 'user_id'=>$user->id])->sum('amount');
        $payouts = PlanProfit::where('user_id', $user->id)->sum('balance');
        $data['investment'] = Deposit::where(['user_id' => $user->id])->take(5)->latest()->get();
        $bonus = UserWallet::whereUserId($user->id)->sum('bonus');
        $ref_bonus = UserWallet::whereUserId($user->id)->sum('referrals');
        $data['bonus'] = $bonus + $ref_bonus;

        
        //dd($data['bonus']);

        return view('mobile.home', [
            'user' => $user,
            'packages' => $packages,
            'total_deposits' => $totalDeposits,
            'active_deposits' => $activeDeposits,
            'last_deposit' => $lastDeposit,
            'total_invest' => $totalInvest + $totalInvest2,
            'payouts' => $payouts,
            'activities' => UserActivity::where('user_id', $user->id)->latest()->take(5)->get()
        ], $data);
    }

    public function packages(){
        $data['basic'] = Deposit::where('plan_id', 1)->get();
        $data['standard'] = Deposit::where('plan_id', 2)->get();
        $data['premium'] = Deposit::where('plan_id', 3)->get();
        $data['mega'] = Deposit::where('plan_id', 4)->get();
        return view('mobile.packages')->with(
            [
                'packages' => Package::with('plans')->get(),
                'data' => $data  
        ]);
    }

      public function updateHash(Request $request, $id){
        $deposit = WalletDeposit::where('id', $id)->first();
       $dd = $deposit->update([
            'hashNo' => $request->hashNo
        ]);
        if($dd){
            $msg = 'Payment details updated successfully';
            $data = [
           'msg' => $msg,
           'alert' => 'success'
       ];
       return response()->json($data);
        }
        $msg = 'Something went wrong';
        $data = [
           'msg' => $msg,
           'alert' => 'error'
       ];
       return response()->json($data);

    }


    public function DepositHash(Request $request, $id){
        $deposit = PendingDeposit::where('id', $id)->first();
       $dd = $deposit->update([
            'hash_no' => $request->hashNo
        ]);
        if($dd){
            $msg = 'Payment details updated successfully';
            $data = [
           'msg' => $msg,
           'alert' => 'success'
       ];
       return response()->json($data);
        }
        $msg = 'Something went wrong';
        $data = [
           'msg' => $msg,
           'alert' => 'error'
       ];
       return response()->json($data);

    }

    public function WalletDeposit(){
        return view('mobile.wallets')
        ->with('deposits', WalletDeposit::where('user_id', auth_user()->id)->latest()->simplePaginate(10));
    }
}
