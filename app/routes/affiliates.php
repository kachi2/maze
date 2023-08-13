<?php 
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'affiliates.'], function(){
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register/agent/', 'AuthController@registers')->name('agency.registers');
Route::get('/registration/{id}', 'AuthController@CompleteRegistration')->name('registration');
Route::post('/completion/{id}', 'AuthController@AccountCompleted')->name('AccountCompleted');
Route::get('/login', 'AuthController@Login')->name('loginform');
Route::post('/logins', 'AuthController@Logins')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::middleware('affiliates')->group(function(){
    Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('index');
Route::get('index', 'HomeController@index')->name('index');
Route::get('/agent/task', 'HomeController@Task')->name('task');
Route::get('/agent/payments', 'HomeController@Payments')->name('payment');
Route::get('/agent/salary', 'HomeController@SalaryPayments')->name('salary');
Route::post('/agent/salary/invoice', 'HomeController@SalaryInvoice')->name('invoice');
Route::get('/agent/salary/invoice/{id}', 'HomeController@SalaryInvoices')->name('invoice');
Route::post('/agent/process/payment/', 'HomeController@paymentProcessor')->name('payment');
Route::get('/agency/account', 'HomeController@account')->name('account');
Route::post('/agency/account/update', 'HomeController@UpdateAccount')->name('UpdateAccount');
Route::post('/agency/password/update', 'HomeController@UpdatePassword')->name('UpdatePassword');


Route::post('/agency/logout', 'HomeController@logout')->name('agency.logout');

#============== Agent referral ==================
Route::get('/referral', 'ReferralController@AgentReferral')->name('agent.referral');
Route::get('/referral/ref/', 'ReferralController@register')->name('agent.referral.register'); 
Route::get('/claim/bonus/{id}', 'ReferralController@ClaimBonus')->name('referal.claimBonus');

});
#============== Agent Admin Routes ===================
Route::get('/admin/index', 'AdminController@Index')->name('agency.admin.index');
Route::get('/admin/referals', 'AdminController@Referals')->name('agency.admin.referals');
Route::get('/admin/payments', 'AdminController@Payments')->name('agency.admin.payments');
Route::get('/admin/salaries', 'AdminController@Salaries')->name('agency.admin.salaries');
Route::get('/admin/invoice/{id}', 'AdminController@Invoices')->name('agency.admin.invoice');
Route::get('/admin/invoice/approve/{id}', 'AdminController@InvoicesApprove')->name('agency.admin.invoice.approve');
Route::get('/admin/invoice/cancel/{id}', 'AdminController@InvoicesCancel')->name('agency.admin.invoice.cancel');
Route::get('/admin/agents/list', 'AdminController@AgentList')->name('admin.agent.list');
Route::get('/admin/agent/details/{id}', 'AdminController@AgentDetails')->name('admin.agent.details');
Route::post('/admin/agent/update/pass/{id}', 'AdminController@changePass')->name('admin.changePass');
Route::get('admin/agent/task', 'AdminController@AgentTask')->name('admin.agent.task');
Route::post('/admin/create/task', 'AdminController@createTask')->name('admin.create.task');
});