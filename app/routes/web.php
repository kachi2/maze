<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

use Illuminate\Support\Facades\Route;
    #========== mobile routes ======================
    Route::domain('app.mazeoptions.com')->group(function(){   
//    Route::group(['prefix' => 'mob'], function(){  
        Route::post('/user/register', 'Auth\RegisterController@create_user')->name('register_user');
        Route::get('complete-registration', 'Auth\CompleteRegistrationController@index')->name('complete_registration');
        Route::post('complete-registration', 'Auth\CompleteRegistrationController@update')->name('complete_registration');


        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('withdrawals', 'WithdrawController@index')->name('withdrawals');
        Route::get('withdrawals/request', 'WithdrawController@request')->name('withdrawals.request');
        Route::post('withdrawals/request', 'WithdrawController@store')->name('withdrawals.request');
        Route::get('withdrawals/{id}/cancel', 'WithdrawController@cancel')->name('withdrawals.cancel');
        Route::get('/withdrawals/delete/{id}', 'WithdrawalController@DeleteAddress')->name('wDeleteAddress');
        Route::post('/withdrawals/add/', 'WithdrawalController@addWithdrawals')->name('addWithdrawals');
        Route::get('deposits', 'DepositController@index')->name('deposits');
        Route::get('deposits/coinpayment/transaction/{id}', 'DepositController@showCoinpaymentTransaction')->name('deposits.coinpayment_transaction');
        Route::get('deposits/blockchain/transaction/{ref}', 'DepositController@showBlockChainTransaction')->name('deposits.blockchain_transaction');
        Route::get('deposits/invest/{id?}', 'DepositController@invest')->name('deposits.invest');
        Route::post('deposits/invest/{id?}', 'DepositController@doInvest')->name('deposits.invests');
        Route::get('/payouts/details/{id?}', 'DepositController@PayoutsDetails')->name('payouts.details');
        Route::post('/transfer/payouts/{id}', 'DepositController@TransferPayouts')->name('transfer.payouts');
        Route::get('/payouts/transfer/history', 'DepositController@PayoutsTransfer')->name('payoutsTransfer.history');
        Route::get('/withdrawals/details/{id}', 'WithdrawController@Details')->name('withdrawals.details');
        Route::post('/wallet/deposits/request', 'WalletDepositController@investFromCripto')->name('wallet.deposits');
        Route::get('deposits/transactions', 'DepositController@showTransactions')->name('deposits.transactions');
        Route::get('deposits/{ref}', 'DepositController@show')->name('deposit');
        Route::post('/update/tnx/hash/{id}', 'HomeController@updateHash')->name('update.tnxHash');
        Route::get('/user/wallets/deposits', 'HomeController@WalletDeposit')->name('wallets.deposit');
        Route::post('/update/depo/hash/{id}', 'HomeController@DepositHash')->name('deposits.tnxHash');
        Route::get('deposits/transactions/{ref}', 'DepositController@showTransaction')->name('deposits.transaction');
        Route::get('deposits/payment/confirmation/{id}','DepositController@saveHashNo')->name('saveHashNo');
        Route::get('payouts', 'PayoutController@index')->name('payouts');
        Route::get('referral', 'ReferralController@index')->name('referral');
        Route::get('bonus/initate/{id}', 'ReferralController@BonusInvest')->name('bonus.initate');
        Route::get('referrals/refer', 'ReferralController@refer')->name('referrals.refer');
        Route::post('referrals/refer', 'ReferralController@send')->name('referrals.refer');
        Route::get('/martets', 'HomeController@Markets')->name('home.markets');
        Route::get('user/notifications', 'AccountController@UserNotifications')->name('user.notifications');
        
        Route::get('testimonies', 'TestimonyController@index')->name('testimonies');
        Route::get('testimonies/add', 'TestimonyController@addTestimony')->name('testimonies.add');
        Route::post('testimonies/add', 'TestimonyController@storeTestimony')->name('testimonies.add');
        Route::get('testimonies/{id}/edit', 'TestimonyController@editTestimony')->name('testimonies.edit');
        Route::post('testimonies/{id}/edit', 'TestimonyController@updateTestimony')->name('testimonies.edit');
        Route::post('testimonies/{id}/delete', 'TestimonyController@destroyTestimony')->name('testimonies.delete');
        Route::get('internal-transfer', 'WalletController@transfer')->name('transfer');
        Route::post('internal-transfer', 'WalletController@doTransfer')->name('transfer');
        Route::post('bonus-transfer', 'WalletController@TransferEarnings')->name('transfer.earnings');
        Route::get('earnbonus', 'WalletController@Bonus')->name('earn.bonus'); 
        
        Route::get('account', 'AccountController@index')->name('account');
        Route::get('account/activities', 'AccountController@activity')->name('account.activities');
        Route::get('settings/profile', 'Settings\ProfileController@index')->name('setting.profile');
        Route::post('settings/profile', 'Settings\ProfileController@update')->name('setting.profile');
        Route::get('settings/password', 'Settings\PasswordController@index')->name('setting.password');
        Route::post('settings/password', 'Settings\PasswordController@update')->name('setting.password');
        Route::get('settings/wallet', 'Settings\WalletController@index')->name('setting.wallet');
        Route::post('settings/wallet', 'Settings\WalletController@update')->name('setting.wallet');
        Route::get('token', 'TokenController@index')->name('token');
        Route::post('token', 'TokenController@generate')->name('token');  
        Route::get('user-photo/{id}/{file_name}', 'AccountController@showPhoto')->name('user.photo');
        Route::post('user-photo/store', 'AccountController@StorePhoto')->name('Store.photo');
        Route::get('perfect-money/callback', 'PerfectMoneyController@validateIpn')->name('perfect_money.callback');
        Route::get('blockchain/callback', 'BlockChainPaymentController@callback')->name('blockchain.callback');
        Route::get('user/packages', 'HomeController@packages')->name('user.packages');
        Route::get('/user/clear/notifications', 'WalletController@clearNotifications')->name('create.notifications');
        Route::get('/user/messages', 'MessageController@index')->name('users.messages.index');
        Route::post('/user/send/message', 'MessageController@SendMessage')->name('users.send.message');
        Route::get('/user/agent', 'MessageController@Agent')->name('users.agent');
        Route::get('/verify/user/transfer', 'WalletController@VerifyTransfer')->name('verify-transfer');
        });

        #=========== Landing pages ====================
    Route::get('/', 'WelcomeController@index')->name('index');
    Auth::routes(['verify' => true]);
    Route::get('/about', 'AboutController@index')->name('about');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/terms', 'TermsController@index')->name('terms');
    Route::get('/privacy-policy', 'TermsController@Privacy')->name('privacy');
    Route::get('/faq', 'FaqController@index')->name('faq');
    Route::get('/plans', 'WelcomeController@plans')->name('plans');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact/store', 'ContactController@store')->name('contact.store');
    Route::get('/activity/affiliates/', 'WelcomeController@Affiliates')->name('affiliates.welcome');


    ## =============== Auth routes ===========================
    
    Route::get('registers/', 'Web\RegisterController@createForm')->name('web.register');
    Route::post('register/', 'Web\RegisterController@create_user')->name('web.register_user');
    Route::post('/logout', 'Web\LoginController@Logout')->name('web.logout');
    Route::get('/logins', 'Web\LoginController@loginForm')->name('web.logins');
    Route::post('/login', 'Web\LoginController@Login')->name('web.login');

    Route::group(['prefix' => 'user', 'as' => 'web.'], function(){  
    #============= logged user ============================ 
    Route::get('/home', 'Web\HomeController@index')->name('home');
    Route::get('/', 'Web\HomeController@index')->name('home');
    Route::get('withdrawals', 'Web\WithdrawController@index')->name('withdrawals');
    Route::get('withdrawals/request', 'Web\WithdrawController@request')->name('withdrawals.request');
    Route::post('withdrawals/store', 'Web\WithdrawController@store')->name('withdrawals.requests');
    Route::get('withdrawals/account', 'Web\WithdrawController@AddAccount')->name('withdrawals.account');
    Route::get('withdrawals/{id}/cancel', 'Web\WithdrawController@cancel')->name('withdrawals.cancel');
    Route::get('/withdrawals/delete/{id}', 'Web\WithdrawController@DeleteAddress')->name('wDeleteAddress');
    Route::post('/withdrawals/add/', 'Web\WithdrawController@addWithdrawals')->name('addWithdrawals');
    Route::get('deposits', 'Web\DepositController@index')->name('deposits');
    Route::get('deposits/coinpayment/transaction/{id}', 'Web\DepositController@showCoinpaymentTransaction')->name('deposits.coinpayment_transaction');
    Route::get('deposits/invest/{id?}', 'Web\DepositController@invest')->name('deposits.invest');
    Route::post('/wallet/deposits/request', 'Web\WalletDepositController@investFromCripto')->name('wallet.deposits');
    Route::post('deposits/invests/{id?}', 'Web\DepositController@doInvest')->name('deposits.invests');  
    Route::post('payouts/transfer/{id?}', 'Web\WalletDepositController@transferPayouts')->name('transferPayouts'); 
    Route::get('payouts/transfer/history/', 'Web\WalletDepositController@PayoutsTransfer')->name('PayoutsTransfer.history');
    Route::get('/payouts/details/{id?}', 'Web\DepositController@PayoutsDetails')->name('payouts.details');
   // Route::post('/user/transfer/payouts/{id}', 'Web\DepositController@TransferPayouts')->name('transfer.payouts');
    Route::get('/withdrawals/details/{id}', 'Web\WithdrawController@Details')->name('withdrawals.details');
    Route::get('deposits/transactions', 'Web\DepositController@showTransactions')->name('deposits.transactions');
    Route::get('deposits/{ref}', 'Web\DepositController@show')->name('deposit');
    Route::get('deposits/transactions/{ref}', 'Web\DepositController@showTransaction')->name('deposits.transaction');
    Route::post('deposits/payment/confirm/','Web\DepositController@saveHashNo')->name('saveHashNo');
    Route::post('wallet/deposits/payment/confirm/','Web\WalletDepositController@saveHashNo')->name('wallet.saveHashNo');
    Route::get('/wallets/deposit/index', 'Web\WalletDepositController@WalletDepositIndex')->name('wallets.deposit.index');
    Route::get('/wallet/deposits', 'Web\WalletDepositController@WalletDeposit')->name('wallets.deposit');
    Route::get('payouts', 'Web\PayoutController@index')->name('payouts');
    Route::get('referral', 'Web\ReferralController@index')->name('referral');
    Route::get('bonus/initate/{id}', 'Web\ReferralController@BonusInvest')->name('bonus.initate');
    Route::get('referrals/refer', 'Web\ReferralController@refer')->name('referrals.refer');
    Route::post('referrals/refer', 'Web\ReferralController@send')->name('referrals.refer');
    Route::get('/markets', 'Web\HomeController@Markets')->name('home.markets');
    Route::get('/notifications', 'Web\AccountController@UserNotifications')->name('user.notifications');
    Route::get('internal/transfers', 'Web\WalletController@transfer')->name('transfer');
    Route::get('internal/sendmoney', 'Web\WalletController@transfers')->name('sendMoney');
    Route::get('/verify/user/transfer', 'Web\WalletController@VerifyTransfer')->name('verify-transfer');
    Route::post('internal/transfer', 'Web\WalletController@doTransfer')->name('transfers');
    Route::post('bonus/transfers', 'Web\WalletController@TransferEarnings')->name('transfer.earnings');
    Route::get('earnbonus', 'Web\WalletController@Bonus')->name('earn.bonus'); 
    Route::get('account', 'Web\AccountController@index')->name('account');
    Route::get('account/activities', 'Web\AccountController@activity')->name('account.activities');
    Route::get('settings/profile', 'Web\Settings\ProfileController@index')->name('setting.profile');
    Route::post('settings/profile', 'Web\Settings\ProfileController@update')->name('setting.profile');
    Route::get('settings/password', 'Web\Settings\PasswordController@index')->name('setting.password');
    Route::post('settings/password', 'Web\Settings\PasswordController@update')->name('setting.password');
    Route::get('settings/wallet', 'Web\Settings\WalletController@index')->name('setting.wallet');
    Route::post('settings/wallet', 'Web\Settings\WalletController@update')->name('setting.wallet');
    Route::get('token', 'Web\TokenController@index')->name('token');
    Route::post('token', 'Web\TokenController@generate')->name('token');
    Route::get('user-photo/{id}/{file_name}', 'Web\AccountController@showPhoto')->name('user.photo');
    Route::post('user-photo/store', 'Web\AccountController@StorePhoto')->name('Store.photo');
    Route::get('perfect-money/callback', 'Web\PerfectMoneyController@validateIpn')->name('perfect_money.callback');
    Route::get('blockchain/callback', 'Web\BlockChainPaymentController@callback')->name('blockchain.callback');
    Route::get('user/packages', 'Web\HomeController@packages')->name('user.packages');
    Route::get('/user/clear/notifications', 'Web\WalletController@clearNotifications')->name('create.notifications');
    Route::get('/user/messages', 'Web\MessageController@index')->name('users.messages.index');
    Route::post('/user/send/message', 'Web\MessageController@SendMessage')->name('users.send.message');
    Route::get('/user/agent', 'Web\MessageController@Agent')->name('users.agent');
    });




        // Route::group(['prefix' => 'affiliates', 'as' => 'affiliates.'], function(){
            Route::domain('affiliates.mazeoptions.com')->group(function(){ 
            Route::get('','Agency\AuthController@Logins')->name('affiliates.loginform');
            Route::get('/', 'Agency\AuthController@Logins')->name('affiliates.loginform');
            Route::group(['prefix' => 'affiliates', 'as' => 'affiliates.'], function(){ 
            Route::get('/register', 'Agency\AuthController@register')->name('register');
            Route::post('/register/submit', 'Agency\AuthController@registers')->name('registers');
            Route::get('/registration/{id}', 'Agency\AuthController@CompleteRegistration')->name('registration');
            Route::post('/completion/{id}', 'Agency\AuthController@AccountCompleted')->name('AccountCompleted');
            Route::get('/login', 'Agency\AuthController@Login')->name('loginform');
            Route::post('/login/submit', 'Agency\AuthController@Logins')->name('login');
            Route::post('/logout', 'Agency\AuthController@logout')->name('logout');

            Route::middleware('agentMiddleware')->group(function(){
            Route::get('/', 'Agency\HomeController@index')->name('index');
            Route::get('/home', 'Agency\HomeController@index')->name('index');
            Route::get('index', 'Agency\HomeController@index')->name('index');
            Route::get('commissions', 'Agency\HomeController@Commissions')->name('commissions');
            Route::get('/referrals/Index', 'Agency\ReferralController@Index')->name('ref.index');
            Route::get('/payments', 'Agency\HomeController@Payments')->name('payment');
            Route::post('payments/invoice', 'Agency\HomeController@PaymentsInvoice')->name('payments.invoice');
            Route::get('/payments/invoice/{id}', 'Agency\HomeController@PaymentsInvoices')->name('payments.invoices');
            Route::post('/process/payment/', 'Agency\HomeController@paymentProcessor')->name('agentProcess.payment');
            Route::get('/account', 'Agency\HomeController@account')->name('account');
            Route::post('/account/update', 'Agency\HomeController@UpdateAccount')->name('UpdateAccount');
            Route::post('/password/update', 'Agency\HomeController@UpdatePassword')->name('UpdatePassword');

            //downliner 

            Route::get('/downliner', 'Agency\DownlinerController@DownlinerIndex')->name('downliner');
            
            
            Route::post('/agency/logout', 'Agency/HomeController@logout')->name('agency.logout');
            
            #============== Agent referral ==================
            Route::get('/referrals/index', 'Agency\ReferralController@AgentReferral')->name('referral');
            Route::get('/referral/ref', 'Agency\ReferralController@register')->name('referral.register'); 
            Route::get('/claim/bonus/{id}', 'Agency\ReferralController@ClaimBonus')->name('claimBonus');
            
            });
            #============== Agent Admin Routes ===================
            Route::get('/admin/index', 'Agency/AdminController@Index')->name('agency.admin.index');
            Route::get('/admin/referals', 'Agency/AdminController@Referals')->name('agency.admin.referals');
            Route::get('/admin/payments', 'Agency/AdminController@Payments')->name('agency.admin.payments');
            Route::get('/admin/salaries', 'Agency/AdminController@Salaries')->name('agency.admin.salaries');
            Route::get('/admin/invoice/{id}', 'Agency/AdminController@Invoices')->name('agency.admin.invoice');
            Route::get('/admin/invoice/approve/{id}', 'Agency/AdminController@InvoicesApprove')->name('agency.admin.invoice.approve');
            Route::get('/admin/invoice/cancel/{id}', 'Agency/AdminController@InvoicesCancel')->name('agency.admin.invoice.cancel');
            Route::get('/admin/agents/list', 'Agency/AdminController@AgentList')->name('admin.agent.list');
            Route::get('/admin/agent/details/{id}', 'Agency/AdminController@AgentDetails')->name('admin.agent.details');
            Route::post('/admin/agent/update/pass/{id}', 'Agency/AdminController@changePass')->name('admin.changePass');
            Route::get('admin/agent/task', 'Agency/AdminController@AgentTask')->name('admin.agent.task');
            Route::post('/admin/create/task', 'Agency/AdminController@createTask')->name('admin.create.task');
            });
        });
    // Route::middleware(['agent'])->group(function(){
    //     Route::get('/', 'Agency\HomeController@index')->name('agency.index');
    //     Route::get('/home', 'Agency\HomeController@index')->name('agency.index');
    //     Route::get('index', 'Agency\HomeController@index')->name('agency.index');
    //     Route::get('/agent/task', 'Agency\HomeController@Task')->name('agency.task');
    //     Route::get('/agent/payments', 'Agency\HomeController@Payments')->name('agency.payment');
    //     Route::get('/agent/salary', 'Agency\HomeController@SalaryPayments')->name('agency.salary');
    //     Route::post('/agent/salary/invoice', 'Agency\HomeController@SalaryInvoice')->name('salary.invoice');
    //     Route::get('/agent/salary/invoice/{id}', 'Agency\HomeController@SalaryInvoices')->name('salaries.invoice');
    //     Route::post('/agent/process/payment/', 'Agency\HomeController@paymentProcessor')->name('agentProcess.payment');
    //     Route::get('/agent/referral', 'Agency\HomeController@AgentReferral')->name('agent.referral');
    //     });

        #========== end of agent routes ======================


        
