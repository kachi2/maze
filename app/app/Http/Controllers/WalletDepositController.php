<?php

namespace App\Http\Controllers;
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
        $deposit = $this->savePendingDeposit($ref, $request->user(), $amount, $amount2, $fee, $paymentMethod);    
        $wallet = WalletAddress::where('name', $paymentMethod)->first();
        $msg = 'Fund Request initiated successfully';
            $data = [
                'wallet' => $wallet,
                'deposit' => $deposit,
                'msg' => $msg,
            ];
            return response()->json($data);
        } catch (Exception $exception) {
            $msg = 'Unable to create deposit transaction';
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data);
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
}
