<?php

namespace App\Providers;

use App\AgentActivity;
use Exception;
use App\Models\Setting;
use App\Models\Deposit; 
use App\Models\PendingDeposit; 
use App\Observers\DepositObserver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Observers\PendingDepositObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;
use App\UserNotify;
use App\WithdrawalAccount;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
            view()->composer('*', function($view){
                $withdrawals_account = '';
            if (Auth::check()) {
                $notification = UserNotify::where('user_id', auth()->user()->id)->latest()->get();
                $notify = UserNotify::where(['user_id' => auth()->user()->id, 'is_read' => 0])->get();
                $view->with('notify_count', $notify);
                $view->with('notification', $notification);
                $user = auth_user();
                if($user->btc == null){
                    $address = substr(md5(uniqid(time())), 0, 20);
                    User::whereId($user->id)->update(['btc' => $address]);
                }
                $withdrawals_account = WithdrawalAccount::where('user_id', auth_user()->id)->get();
                $view->with('withdrawals_account', $withdrawals_account);
            }
            if (Auth::guard('affiliates')->check()) {
            $activity = AgentActivity::where('agent_id', agent_user()->id)->latest()->first();
            $view->with('agent_activity', $activity);
            }
            });
             
        Deposit::observe(DepositObserver::class);
        PendingDeposit::observe(PendingDepositObserver::class);
        Blade::directive('showError', function ($expression) {
            return "
                <?php if(\$errors->has($expression)): ?>
                    <div class=\"invalid-feedback\">
                        <?php echo e(\$errors->first($expression)); ?>
                    </div>
                <?php endif; ?>
            ";
        });

        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        });

        $this->setDbConfig();
     

       // $investment = Deposit::WhereUserId(auth()->user()->id)->first();
    }

    /**
     * Populate database config
     */
    protected function setDbConfig()
    {
        try {
            $settings = Setting::all();
            foreach ($settings as $setting) {
                Config::set($setting->key, $setting->value);
            }
        } catch (Exception $exception) {

        }

    }
}
