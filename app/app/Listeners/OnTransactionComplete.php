<?php
namespace App\Listeners;
use App\Models\PendingDeposit;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Kevupton\LaravelCoinpayments\Events\Transaction\TransactionComplete;


class OnTransactionComplete
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct ()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param TransactionComplete $event
     * @return ResponseFactory|Response
     */
    public function handle (TransactionComplete $event)
    {
        $deposit = PendingDeposit::whereRef($event->transaction->invoice)->firstOrFail();
        if ($deposit->status == PendingDeposit::STATUS_PENDING) {
            $deposit->status = PendingDeposit::STATUS_VERIFIED;
            $deposit->save();
            $deposit->makeActive();
        }

        Log::info("\n>>\tTRANSACTION COMPLETED");
        Log::info($event->transaction->toJson(JSON_PRETTY_PRINT));
        return response(Response::HTTP_OK);
    }
}
