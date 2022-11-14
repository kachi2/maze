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
#==================agent app routes =========================

Route::domain('agency.mazeoption.com')->group(function(){
    //Route::get('/agent/complete/registration', )
    Route::get('/register/agents', 'Agency\AuthController@register')->name('agency.register');
    Route::post('/register/agent/', 'Agency\AuthController@registers')->name('agency.registers');
    Route::get('/registration/{id}', 'Agency\AuthController@CompleteRegistration')->name('agency.registration');
    Route::post('/completion/{id}', 'Agency\AuthController@AccountCompleted')->name('agency.AccountCompleted');
    Route::get('/login', 'Agency\AuthController@Login')->name('Agent-login');
    Route::post('/logins', 'Agency\AuthController@Logins')->name('agent.login');
    Route::post('/logout', 'Agency\AuthController@logout')->name('agent.logout');
    Route::get('/', 'Agency\HomeController@index')->name('agency.index');
    Route::get('/home', 'Agency\HomeController@index')->name('agency.index');
    Route::get('index', 'Agency\HomeController@index')->name('agency.index');
    Route::get('/agent/task', 'Agency\HomeController@Task')->name('agency.task');
    Route::get('/agent/payments', 'Agency\HomeController@Payments')->name('agency.payment');
    Route::get('/agent/salary', 'Agency\HomeController@SalaryPayments')->name('agency.salary');
    Route::post('/agent/salary/invoice', 'Agency\HomeController@SalaryInvoice')->name('salary.invoice');
    Route::get('/agent/salary/invoice/{id}', 'Agency\HomeController@SalaryInvoices')->name('salaries.invoice');
    Route::post('/agent/process/payment/', 'Agency\HomeController@paymentProcessor')->name('agentProcess.payment');
    Route::get('/agent/referral', 'Agency\HomeController@AgentReferral')->name('agent.referral');
    });
    #========== end of agent routes ======================

    
    Route::get('/', 'WelcomeController@index')->name('index');
    Auth::routes(['verify' => true]);
    
    route::post('/user/register', 'Auth\RegisterController@create_user')->name('register_user');
    Route::get('complete-registration', 'Auth\CompleteRegistrationController@index')->name('complete_registration');
    Route::post('complete-registration', 'Auth\CompleteRegistrationController@update')->name('complete_registration');
    
    Route::get('/about', 'AboutController@index')->name('about');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/terms', 'TermsController@index')->name('terms');
    Route::get('/faq', 'FaqController@index')->name('faq');
    Route::get('/plans', 'WelcomeController@plans')->name('plans');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact/store', 'ContactController@store')->name('contact.store');
    
    Route::prefix('dashboard')->group(function(){ 
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('withdrawals', 'WithdrawController@index')->name('withdrawals');
    Route::get('withdrawals/request', 'WithdrawController@request')->name('withdrawals.request');
    Route::post('withdrawals/request', 'WithdrawController@store')->name('withdrawals.request');
    Route::post('withdrawals/{id}/cancel', 'WithdrawController@cancel')->name('withdrawals.cancel');
    Route::get('deposits', 'DepositController@index')->name('deposits');
    Route::get('deposits/coinpayment/transaction/{id}', 'DepositController@showCoinpaymentTransaction')->name('deposits.coinpayment_transaction');
    Route::get('deposits/blockchain/transaction/{ref}', 'DepositController@showBlockChainTransaction')->name('deposits.blockchain_transaction');
    Route::get('deposits/invest/{id?}', 'DepositController@invest')->name('deposits.invest');
    Route::post('deposits/invest/{id?}', 'DepositController@doInvest')->name('deposits.invests');
    Route::get('/payouts/details/{id?}', 'DepositController@PayoutsDetails')->name('payouts.details');
    Route::post('/transfer/payouts/{id}', 'DepositController@TransferPayouts')->name('transfer.payouts');
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
    
    });
    
    
    Route::group(['prefix' => 'user', 'as' => 'web.'], function(){
     Route::get('/home', 'Web\HomeController@index')->name('home');
    Route::get('/', 'Web\HomeController@index')->name('home');
    Route::get('withdrawals', 'Web\WithdrawController@index')->name('withdrawals');
    Route::get('withdrawals/request', 'Web\WithdrawController@request')->name('withdrawals.request');
    Route::post('withdrawals/request', 'Web\WithdrawController@store')->name('withdrawals.request');
    Route::post('withdrawals/{id}/cancel', 'Web\WithdrawController@cancel')->name('withdrawals.cancel');
    Route::get('deposits', 'DepositController@index')->name('deposits');
    Route::get('deposits/coinpayment/transaction/{id}', 'Web\DepositController@showCoinpaymentTransaction')->name('deposits.coinpayment_transaction');
    Route::get('deposits/invest/{id?}', 'Web\DepositController@invest')->name('deposits.invest');
    Route::post('/wallet/deposits/request', 'Web\WalletDepositController@investFromCripto')->name('wallet.deposits');
    Route::post('deposits/invests/{id?}', 'Web\DepositController@doInvest')->name('deposits.invests');
    Route::get('/payouts/details/{id?}', 'Web\DepositController@PayoutsDetails')->name('payouts.details');
    Route::post('/transfer/payouts/{id}', 'Web\DepositController@TransferPayouts')->name('transfer.payouts');
    Route::get('/withdrawals/details/{id}', 'Web\WithdrawController@Details')->name('withdrawals.details');
    Route::get('deposits/transactions', 'Web\DepositController@showTransactions')->name('deposits.transactions');
    Route::get('deposits/{ref}', 'Web\DepositController@show')->name('deposit');
    Route::get('deposits/transactions/{ref}', 'Web\DepositController@showTransaction')->name('deposits.transaction');
    Route::post('deposits/payment/confirm/','Web\DepositController@saveHashNo')->name('saveHashNo');
    Route::get('/wallets/deposit/index', 'Web\WalletDepositController@WalletDepositIndex')->name('wallets.deposit.index');
    Route::get('/wallet/deposits', 'Web\WalletDepositController@WalletDeposit')->name('wallets.deposit');
    Route::get('payouts', 'Web\PayoutController@index')->name('payouts');
    Route::get('referral', 'Web\ReferralController@index')->name('referral');
    Route::get('bonus/initate/{id}', 'Web\ReferralController@BonusInvest')->name('bonus.initate');
    Route::get('referrals/refer', 'Web\ReferralController@refer')->name('referrals.refer');
    Route::post('referrals/refer', 'Web\ReferralController@send')->name('referrals.refer');
    
    Route::get('/martets', 'Web\HomeController@Markets')->name('home.markets');
    Route::get('/notifications', 'Web\AccountController@UserNotifications')->name('user.notifications');
    
    Route::get('internal-transfer', 'Web\WalletController@transfer')->name('transfer');
    Route::post('internal-transfer', 'Web\WalletController@doTransfer')->name('transfer');
    Route::post('bonus-transfer', 'Web\WalletController@TransferEarnings')->name('transfer.earnings');
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
    
