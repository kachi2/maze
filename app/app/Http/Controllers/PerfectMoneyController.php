<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\PendingDeposit;
use App\Models\Referral;
use App\Models\UserWallet;
use App\Modules\PerfectMoney;
use App\User;
use Illuminate\Http\Request;

class PerfectMoneyController extends Controller
{

    /**
     * Handled on callback of IPN
     *
     * @param Request $request
     */
    public function validateIpn(Request $request)
    {
        $deposit = PendingDeposit::whereRef($request->input('PAYMENT_ID'))->firstOrFail();

        $perfectMoney = new PerfectMoney();

        if ($perfectMoney->validatePurchase($request, $deposit->verifying_amount)) {
            if ($deposit->status == PendingDeposit::STATUS_PENDING) {
                $deposit->status = PendingDeposit::STATUS_VERIFIED;
                $deposit->save();
                $activeDeposit = $deposit->makeActive();
                $this->updateReferral($activeDeposit);
            }
            echo 'deposit successful';
        } else {
            echo 'deposit failed';
        }
    }

    protected function updateReferral(Deposit $deposit) {
        $ref = Referral::whereUserId($deposit->user_id)->first();
        if(!$ref) {
            return;
        }

        $refer = User::find($ref->referrer_id);
        if (!$refer) {
            return;
        }

        $interest = $deposit->amount * config('referral.interest_percent', 5) / 100;

        $ref->interest = $ref->interest + $interest;
        $ref->save();
        UserWallet::addAmount($refer, $interest);
    }
}
