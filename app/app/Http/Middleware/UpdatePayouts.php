<?php

namespace App\Http\Middleware;

use App\Models\Deposit;
use App\Models\Package;
use App\Models\Payout;
use App\Models\UserWallet;
use App\MarketList;
use App\PlanProfit;

use Closure;
use App\Notifications\InvestmentCompleted;
use Illuminate\Support\Facades\Cache;

class UpdatePayouts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Cache::remember('update_payout', now()->addMinutes(60), function () {
           $this->updatePayouts();
            return 'foo';
        });
        return $next($request);
    }


    protected function updatePayouts() {
        $deposits = Deposit::with('user')->whereStatus(Deposit::STATUS_ACTIVE)->get();
        
       foreach ($deposits as $deposit) {
           $payableAmount = 0;
           switch ($deposit->payment_period) {
               case Package::PERIOD_HOURLY:
                   $hoursGone = now()->diffInHours($deposit->created_at);

                  // dd($hoursGone);
                   $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $hoursGone) - $deposit->paid_amount;
                   break;
               case Package::PERIOD_DAILY:
                   $daysGone = now()->diffInDays($deposit->created_at);
                   $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $daysGone) - $deposit->paid_amount;
                   break;
               case Package::PERIOD_WEEKLY:
                   $weeksGone = now()->diffInWeeks($deposit->created_at);
                   $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $weeksGone) - $deposit->paid_amount;
                   break;
               case Package::PERIOD_MONTHLY:
                   $monthsGone = now()->diffInMonths($deposit->created_at);
                   $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $monthsGone) - $deposit->paid_amount;
                   break;
               case Package::PERIOD_2_MONTHS:
                   $monthsGone = now()->diffInMonths($deposit->created_at);
                   if($monthsGone % 2 == 0) {
                       $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $monthsGone) - $deposit->paid_amount;
                   }
                   break;
               case Package::PERIOD_3_MONTHS:
                   $monthsGone = now()->diffInMonths($deposit->created_at);
                   if($monthsGone % 3 == 0) {
                       $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $monthsGone) - $deposit->paid_amount;
                   }
                   break;
               case Package::PERIOD_6_MONTHS:
                   $monthsGone = now()->diffInMonths($deposit->created_at);
                   if($monthsGone % 6 == 0) {
                       $payableAmount = (($deposit->amount * $deposit->profit_rate / 100) * $monthsGone) - $deposit->paid_amount;
                   }
                   break;
           }
           if ($payableAmount > 0) {
               if (($payableAmount + $deposit->paid_amount) > $deposit->profit) {
                   $payableAmount = $deposit->profit - $deposit->paid_amount;
               }  
               if ($payableAmount > 0) {
                   Payout::create([
                       'ref' => generate_reference(),
                       'amount' => $payableAmount,
                       'profit' => $payableAmount,
                       'user_id' =>  $deposit->user_id,
                       'plan_id' => $deposit->plan_id,
                       'deposit_id' => $deposit->id,
                   ]);
                   $deposit->paid_amount =  $payableAmount + $deposit->paid_amount;
                   $deposit->save();
                 //  PlanProfit::addAmount($deposit->user, $payableAmount,$deposit->plan_id);
               }
           }

           if ($deposit->expires_at <= now()) {
                   $amountToPay = $deposit->profit;
                  // dd($amountToPay);
               if ($deposit->paid_amount < $deposit->profit) {
                   $amountToPay = $deposit->profit - $deposit->paid_amount;
                   Payout::create([
                       'ref' => generate_reference(),
                       'amount' => $amountToPay,
                       'profit' => $amountToPay,
                       'user_id' =>  $deposit->user_id,
                       'plan_id' => $deposit->plan_id,
                       'deposit_id' => $deposit->id,
                   ]);
               }
                   $deposit->paid_amount = $deposit->profit;
                   $deposit->status = 1;
                   $deposit->save();
                   PlanProfit::addAmount($deposit->user,  $amountToPay, $deposit->plan_id);
                   if(auth_user()){
                    request()->user()->notify(new InvestmentCompleted($deposit));
                   }
               
          }
       }

       $client = new \GuzzleHttp\Client();
       $response = $client->get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd');
       $res = $response->getBody()->getContents();
       $resp = json_decode($res, true);
       $num = 15;
       if(count($resp) > 0){
        $market = MarketList::get();
        if(count($market) > 0){
            for($x = 0; $x <=  $num; $x++){
               $market[$x]->fill([
                'name' => $resp[$x]['name'],
                'symbol' => $resp[$x]['symbol'],
                'image' => $resp[$x]['image'],
                'current_price' => $resp[$x]['current_price'], 
                'price_change_24h' => $resp[$x]['price_change_24h'], 
                'price_change_percentage_24h'=> $resp[$x]['price_change_percentage_24h'], 
                'market_cap_change_24h' => $resp[$x]['market_cap_change_24h'], 
                'market_cap_change_percentage_24h' => $resp[$x]['market_cap_change_percentage_24h'],
                'market_cap' => $resp[$x]['market_cap'],
         ])->save();
            }
        }else {
        for($x = 0; $x <=  $num; $x++){
            MarketList::create([
                'name' => $resp[$x]['name'],
                'symbol' => $resp[$x]['symbol'],
                'image' => $resp[$x]['image'],
                'current_price' => $resp[$x]['current_price'], 
                'price_change_24h' => $resp[$x]['price_change_24h'], 
                'price_change_percentage_24h'=> $resp[$x]['price_change_percentage_24h'], 
                'market_cap_change_24h' => $resp[$x]['market_cap_change_24h'], 
                'market_cap_change_percentage_24h' => $resp[$x]['market_cap_change_percentage_24h'],
                'market_cap' => $resp[$x]['market_cap'],
            ]);
        }
     }
       }
    }
}
