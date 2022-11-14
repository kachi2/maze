<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\WalletAddress;
use App\Models\UserWallet;
use Exception;
use App\WalletDeposit;

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
        ->with('deposits', WalletDeposit::where('user_id', auth_user()->id)->latest()->simplePaginate(20))
        ->with('pending', WalletDeposit::where('status', '0')->get())
        ->with('total', WalletDeposit::where(['user_id' => auth_user()->id])->sum('amount'));
    }

    public function WalletDeposit(){
     

    }


}
