<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\MarketList;
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
        $resp = MarketList::get();
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
