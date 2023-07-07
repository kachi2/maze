<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers;


use App\Models\Deposit;
use App\Models\Package;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\MarketList;

class FaqController
{

    /**
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $resp = MarketList::get();
        return view('faq', [ 
        ])->with('coins', $resp);
    }
}
