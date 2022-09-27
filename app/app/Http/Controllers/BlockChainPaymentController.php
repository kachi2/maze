<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/21/2018
 * Time: 8:10 AM
 */

namespace App\Http\Controllers;


use App\Models\Deposit;
use App\Models\PendingDeposit;
use App\Models\Referral;
use App\Models\UserWallet;
use App\Modules\BlockChain;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\InvestmentCompleted;

class BlockChainPaymentController extends Controller
{
    protected $blockChain;

    /**
     *  Class constructor.
     */
    public function __construct()
    {
        $this->blockChain = new BlockChain();
    }

    /**
     * Coingate callback
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function callback(Request $request)
    {
        Log::info($request);
        $deposit = PendingDeposit::whereRef($request->input('order_id'))->firstOrFail();
        try {
            if ($this->blockChain->verifyPayment($request, $deposit) && $deposit->status < 1) {
                if ($deposit->status == PendingDeposit::STATUS_PENDING) {
                    $deposit->status = PendingDeposit::STATUS_VERIFIED;
                    $deposit->save();
                    $activeDeposit = $deposit->makeActive();
                    $this->updateReferral($activeDeposit);
                    
                    try {
            $request->user()->notify(new InvestmentCompleted($deposit));
        } catch (Exception $exception) {

        }
                }
            }

            echo "*ok*";
        } catch (Exception $e) {
            Log::error($e->getMessage());
            report($e);
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
