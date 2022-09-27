<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanProfit extends Model
{

    //

    protected $fillable = [

        'plan_id', 'user_id', 'balance', 'prev_balance'
    ];
   

    public static function addAmount($user, $amount, $planId)
    {
        $PlanWallet = (new PlanProfit)->where(['user_id'=> $user->id, 'plan_id'=>$planId])->first();
        if (!$PlanWallet) {
            $PlanWallet = PlanProfit::create([
                'user_id' => $user->id,
                'plan_id' => $planId,
                'balance' => $amount,
                'prev_balance' => 0,
            ]);
        } else {
            $PlanWallet->balance = $PlanWallet->balance + $amount;
            $PlanWallet->prev_balance = $PlanWallet->balance;
            $PlanWallet->save();
        }
    }
}
