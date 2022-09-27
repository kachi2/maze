<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\DepositTransaction;
use App\Models\PendingDeposit;
use App\Models\PendingTrade;
use App\Models\Referral;
use App\Models\UserWallet;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Kevupton\LaravelCoinpayments\Exceptions\IpnIncompleteException;
use Kevupton\LaravelCoinpayments\Facades\Coinpayments;
use Kevupton\LaravelCoinpayments\Models\Ipn;

class CoinpaymentsController extends Controller
{

    /**
     * Handled on callback of IPN
     *
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function validateIpn(Request $request)
    {
     
        Log::info($request);
        try {
            /** @var Ipn $ipn */
            $ipn = Coinpayments::validateIPNRequest($request);
            Log::info($ipn);
            if ($ipn->isApi()) {
                $deposit = PendingDeposit::whereRef($ipn->invoice)->firstOrFail();
                if ($deposit->status == PendingDeposit::STATUS_PENDING) {
                    $deposit->status = PendingDeposit::STATUS_VERIFIED;
                    $deposit->save();
                    $activeDeposit = $deposit->makeActive();
                    $this->updateReferral($activeDeposit);
                }
            }
          

            return response(Response::HTTP_OK);
        } catch (IpnIncompleteException $e) {
            $ipn = $e->getIpn();
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
