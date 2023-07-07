<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\MarketList;
use Illuminate\Http\Request;
use App\User;
use App\WalletAddress;
use App\Models\UserWallet;
use App\PayoutsHistory;
use App\PlanProfit;
use Exception;
use App\WalletDeposit;
use Illuminate\Support\Facades\Session;

class WalletDepositController extends Controller
{
    //
    protected function investFromCripto(Request $request)
    {
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');
        $ref = generate_reference();
        $fee = 0.05;
        $cost = $amount + $fee;
        $coins = $paymentMethod;
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
            $resp = MarketList::where('name',$coins)->first();
            $amount2 = $amount / $resp['current_price'];
        $transaction = $this->savePendingDeposit($ref, $request->user(), $amount, $amount2, $fee, $paymentMethod);    
        $wallet = WalletAddress::where('name', $paymentMethod)->first();
   
            \Session::flash('msg', 'Deposit Initiated Successfully');
            \Session::flash('alert', 'success');
            return view('wallet.payment')
            ->with('wallet', $wallet)
            ->with('transaction', $transaction);
        } catch (Exception $exception) {
            $msg = 'Unable to create deposit transaction';
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           \Session::flash('msg', 'Operation Failed, something went wrong');
            \Session::flash('alert', 'error');
            return back();
        }
    }
    protected function savePendingDeposit($ref,User $user, $amount, $amount2, $fee, $paymentMethod)
     {
        return WalletDeposit::create([
            'ref' => $ref,
            'user_id' => $user->id,
            'fee' => $fee,
            'amount2'=> $amount2,
            'amount' => $amount,
            'currency1' => 'USD',
            'currency2' => $paymentMethod,
            'amount' => $amount,
            'payment_method' => $paymentMethod,
        ]);
    }

    public function WalletDepositIndex(){
        return view('wallet.deposits')
        ->with('deposits', WalletDeposit::where('user_id', auth_user()->id)->latest()->simplePaginate(10))
        ->with('pending', WalletDeposit::where(['user_id' => auth_user()->id, 'status' => '0'])->get())
        ->with('total', WalletDeposit::where(['user_id' => auth_user()->id])->sum('amount'));
    }

     
    public function saveHashNo(Request $request){
        $deposit = WalletDeposit::where('ref', $request->ref)->first()
                   ->update(['hashNo' => $request->hash]);
       // dd($request->hash);
           if($deposit){
                   Session::flash('alert', 'success');
                   Session::flash('done', 'readonly');
                   Session::flash('message', 'Your request is pending, Your deposit will be approved once confirmed');
                return redirect()->route('web.wallets.deposit.index');
        }else{
            return back();
        }
                   
    }


    #================ payouts transfer ========================

    public function transferPayouts(Request $request, $id){

        $payouts = PlanProfit::where(['user_id' => auth_user()->id, 'plan_id' => decrypt($id)])->first();
        if(empty($payouts)){
            Session::flash('alert', 'error');
            Session::flash('message', 'Payout balance is too low for this request');
            return back();
        }
        if($request->amount < 0){
            Session::flash('alert', 'error');
            Session::flash('message', 'Payout amount cannot be zero or negative value');
            return back();
        }

        if($payouts->balance < $request->amount){
            Session::flash('alert', 'error');
            Session::flash('message', 'Payout balance is too low for this request');
            return back();
        }
        $balance = $payouts->balance;
        $newBalance = $balance - $request->amount;
        PlanProfit::where(['user_id' => auth_user()->id, 'plan_id' => decrypt($id)])
                    ->update([
                        'prev_balance' => $balance,
                        'balance' => $newBalance
                    ]);
                    PayoutsHistory::create([
                        'ref' => generate_reference(),
                        'user_id' => auth_user()->id,
                        'amount' => $request->amount,
                        'prev_balance' => $payouts->balance,
                        'avail_balance' => $newBalance
                    ]);
                UserWallet::addAmount(auth_user(), $request->amount);
                Session::flash('alert', 'success');
                Session::flash('message', 'Payout transfered to wallet successfully');
               
                return back();

    }

    public function PayoutsTransfer(){
        return view('deposit.transfers')
        ->with('payouts', PayoutsHistory::where('user_id', auth_user()->id)->latest()->get());
}


}
