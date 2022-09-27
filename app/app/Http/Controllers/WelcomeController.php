<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers;


use App\Models\Deposit;
use App\Models\Testimony;
use App\Models\Package;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController
{

    /**
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */

     public function __construct()
     {
     }
    public function index(Request $request)
    {
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin%2Cethereum%2Clitecoin%2Cdogecoin%2Cusd-coin%2Cbinancecoin%2Ctron%tezos%2Chelium&order=market_cap_desc&per_page=8&page=1&sparkline=false&price_change_percentage=2');
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
       // dd($resp);
       
        $withdrawals = Withdrawal::with('user')->whereStatus(Withdrawal::STATUS_PAID)->latest()->take(10)->get();
        $deposits = Deposit::with('user')->latest()->take(10)->get();
        $testimonies = Testimony::with('user')->whereStatus(Testimony::STATUS_APPROVED)->latest()->take(10)->get();
        $packages = Package::with('plans')->get();
        return view('welcome', [
            'withdrawals' => $withdrawals,
            'deposits' => $deposits,
            'testimonies' => $testimonies,
            'packages' => $packages,
            'coins' => $resp
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function plans(Request $request)
    {
        $withdrawals = Withdrawal::with('user')->whereStatus(Withdrawal::STATUS_PAID)->latest()->take(10)->get();
        $deposits = Deposit::with('user')->latest()->take(10)->get();

        $packages = Package::with('plans')->get();

        return view('plans', [
            'withdrawals' => $withdrawals,
            'deposits' => $deposits,
            'packages' => $packages
        ]);
    }
}
