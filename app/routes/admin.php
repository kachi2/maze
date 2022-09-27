<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('admin.home');

Route::get('message-users', 'MessageController@index')->name('admin.message_users');
Route::post('message-users', 'MessageController@doMessageUsers')->name('admin.message_users');

Route::get('users', 'UserController@index')->name('admin.users');

Route::get('users/send-bonus/users', 'UserController@sendUsersBonus')->name('admin.users.send_users_bonus');
Route::post('users/send-bonus/users', 'UserController@doSendUsersBonus')->name('admin.users.send_users_bonus');
Route::get('users/send-bonus/{id}', 'UserController@sendBonus')->name('admin.users.send_bonus');
Route::post('users/send-bonus/{id}', 'UserController@doSendBonus')->name('admin.users.send_bonus');
Route::get('users/send-message/{id}', 'UserController@sendMessage')->name('admin.users.send_message');
Route::post('users/send-message/{id}', 'UserController@doSendMessage')->name('admin.users.send_message');
Route::get('/users/activities/{id}', 'UserController@activity')->name('admin.users.activity');
Route::get('/users/settings/{id}', 'UserController@pass')->name('admin.users.settings');
Route::post('/users/settings/update/{id}', 'UserController@settings')->name('admin.users.settings-update');

Route::get('users/invest', 'UserController@invest')->name('admin.users.invest');
Route::post('users/invest', 'UserController@doInvest')->name('admin.users.invest');
Route::get('users/{id}/edit', 'UserController@editUser')->name('admin.users.edit');
Route::post('users/{id}/edit', 'UserController@updateUser')->name('admin.users.edit');
Route::post('users/{id}/delete', 'UserController@destroyUser')->name('admin.users.delete');
Route::post('users/{id}/rank-admin', 'UserController@rankUserAdmin')->name('admin.users.rank_admin');
Route::post('users/{id}/unrank-admin', 'UserController@UnRankUserAdmin')->name('admin.users.unrank_admin');
Route::get('users/add', 'UserController@addUser')->name('admin.users.add');
Route::post('users/add', 'UserController@storeUser')->name('admin.users.add');
Route::get('users/{id}', 'UserController@showUser')->name('admin.users.show');

Route::get('packages', 'PackageController@index')->name('admin.packages');
Route::get('packages/add', 'PackageController@addPackage')->name('admin.packages.add');
Route::post('packages/add', 'PackageController@storePackage')->name('admin.packages.add');
Route::get('packages/{id}', 'PackageController@showPackage')->name('admin.packages.show');
Route::get('packages/{id}/edit', 'PackageController@editPackage')->name('admin.packages.edit');
Route::post('packages/{id}/edit', 'PackageController@updatePackage')->name('admin.packages.edit');
Route::post('packages/{id}/delete', 'PackageController@destroyPackage')->name('admin.packages.delete');

Route::get('plans', 'PackageController@showPlans')->name('admin.plans');
Route::get('plans/add', 'PackageController@addPlan')->name('admin.plans.add');
Route::post('plans/add', 'PackageController@storePlan')->name('admin.plans.add');
Route::get('plans/{id}', 'PackageController@showPlan')->name('admin.plans.show');
Route::get('plans/{id}/edit', 'PackageController@editPlan')->name('admin.plans.edit');
Route::post('plans/{id}/edit', 'PackageController@updatePlan')->name('admin.plans.edit');
Route::post('plans/{id}/delete', 'PackageController@destroyPlan')->name('admin.plans.delete');

Route::get('withdrawals', 'WithdrawalController@index')->name('admin.withdrawals');
Route::post('withdrawals/{id}/delete', 'WithdrawalController@destroyUser')->name('admin.withdrawals.delete');
Route::post('withdrawals/{id}/mark-paid', 'WithdrawalController@markPaid')->name('admin.withdrawals.mark_paid');
Route::post('withdrawals/{id}/mark-pending', 'WithdrawalController@markPending')->name('admin.withdrawals.mark_pending');

Route::get('deposits', 'DepositController@index')->name('admin.deposits');
Route::get('payment/request', 'DepositController@approveIndex')->name('admin.payment_request');
Route::get('deposits/add/{id?}', 'DepositController@addDeposit')->name('admin.deposits.add');
Route::post('deposits/add/{id?}', 'DepositController@storeDeposit')->name('admin.deposits.add');
Route::post('deposits/{id}/mark-expired', 'DepositController@markExpired')->name('admin.deposits.mark_expired');
Route::post('deposits/{id}/mark-completed', 'DepositController@markCompleted')->name('admin.deposits.mark_completed');
Route::post('deposits/request/{id}', 'DepositController@depositApprove')->name('admin.deposits.approve');

Route::get('payouts', 'PayoutController@index')->name('admin.payouts');
Route::get('referrals', 'ReferralController@index')->name('admin.referrals');

Route::get('withdrawals', 'WithdrawalController@index')->name('admin.withdrawals');
Route::get('withdrawals/add', 'WithdrawalController@addWithdrawal')->name('admin.withdrawals.add');
Route::post('withdrawals/add', 'WithdrawalController@storeWithdrawal')->name('admin.withdrawals.add');
Route::post('withdrawals/{id}/delete', 'WithdrawalController@destroyUser')->name('admin.withdrawals.delete');
Route::post('withdrawals/{id}/mark-paid', 'WithdrawalController@markPaid')->name('admin.withdrawals.mark_paid');
Route::post('withdrawals/{id}/mark-as-paid', 'WithdrawalController@markAsPaid')->name('admin.withdrawals.mark_as_paid');
Route::post('withdrawals/{id}/mark-pending', 'WithdrawalController@markPending')->name('admin.withdrawals.mark_pending');
Route::post('withdrawals/{id}/cancel', 'WithdrawalController@cancel')->name('admin.withdrawals.cancel');

Route::get('testimonies', 'TestimonyController@index')->name('admin.testimonies');
Route::get('testimonies/add', 'TestimonyController@addTestimony')->name('admin.testimonies.add');
Route::post('testimonies/add', 'TestimonyController@storeTestimony')->name('admin.testimonies.add');
Route::post('testimonies/{id}/mark-approve', 'TestimonyController@markApproved')->name('admin.testimonies.approve');
Route::post('testimonies/{id}/mark-disapprove', 'TestimonyController@markDisapproved')->name('admin.testimonies.disapprove');
Route::get('testimonies/{id}/edit', 'TestimonyController@editTestimony')->name('admin.testimonies.edit');
Route::post('testimonies/{id}/edit', 'TestimonyController@updateTestimony')->name('admin.testimonies.edit');
Route::post('testimonies/{id}/delete', 'TestimonyController@destroyTestimony')->name('admin.testimonies.delete');

Route::get('settings', 'SettingController@index')->name('admin.setting');
Route::post('settings', 'SettingController@update')->name('admin.setting');

Route::get('tokens', 'TokenController@index')->name('admin.tokens');
Route::get('tokens/add', 'TokenController@addToken')->name('admin.tokens.add');
Route::post('tokens/add', 'TokenController@storeToken')->name('admin.tokens.add');
Route::post('tokens/{id}/delete', 'TokenController@destroy')->name('admin.tokens.delete');


