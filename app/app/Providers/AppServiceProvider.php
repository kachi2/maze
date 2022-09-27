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
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Observers\PendingDepositObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;
use App\UserNotify;

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
            if (Auth::check()) {
                $notification = UserNotify::where('user_id', auth()->user()->id)->latest()->get();
                $view->with('notification', $notification);
                
            }
            if (Auth::guard('agent')->check()) {
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
