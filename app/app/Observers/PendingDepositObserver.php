<?php

namespace App\Observers;

use Exception;
use App\Models\PendingDeposit;
use App\Notifications\InvestmentCreated;

class PendingDepositObserver
{
    /**
     * Handle the pending deposit "created" event.
     *
     * @param  \App\Models\PendingDeposit  $pendingDeposit
     * @return void
     */
    public function created(PendingDeposit $pendingDeposit)
    {
        try {
            $pendingDeposit->user->notify(new InvestmentCreated($deposit));
        } catch (Exception $exception) {

        }
    }

    /**
     * Handle the pending deposit "updated" event.
     *
     * @param  \App\Models\PendingDeposit  $pendingDeposit
     * @return void
     */
    public function updated(PendingDeposit $pendingDeposit)
    {
        //
    }

    /**
     * Handle the pending deposit "deleted" event.
     *
     * @param  \App\Models\PendingDeposit  $pendingDeposit
     * @return void
     */
    public function deleted(PendingDeposit $pendingDeposit)
    {
        //
    }

    /**
     * Handle the pending deposit "restored" event.
     *
     * @param  \App\Models\PendingDeposit  $pendingDeposit
     * @return void
     */
    public function restored(PendingDeposit $pendingDeposit)
    {
        //
    }

    /**
     * Handle the pending deposit "force deleted" event.
     *
     * @param  \App\Models\PendingDeposit  $pendingDeposit
     * @return void
     */
    public function forceDeleted(PendingDeposit $pendingDeposit)
    {
        //
    }
}
