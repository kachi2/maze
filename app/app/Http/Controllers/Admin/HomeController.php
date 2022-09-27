<?php
/**
 * Created by PhpStorm.
 * User: COMPUTER
 * Date: 9/6/2017
 * Time: 11:26 AM
 */

namespace App\Http\Controllers\Admin;


use App\Models\Deposit;
use App\Models\Package;
use App\Models\Withdrawal;
use App\User;
use App\UserActivity;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Show the admin home page.
     *
     * @return Response
     */
    public function home()
    {
        $packages = Package::with('plans')->get();
        $totalUsers = User::count();
        $todayUsers = User::where('created_at', '>=', today())->count();
        $adminUsers = User::whereIsAdmin(true)->count();

        $totalDeposits = Deposit::sum('amount');
        $activeDeposits = Deposit::whereStatus(Deposit::STATUS_ACTIVE)->sum('amount');
        $lastDeposit = Deposit::latest()->take(1)->sum('amount');

        $totalWithdrawals = Withdrawal::where('status', '!=', Withdrawal::STATUS_CANCELED)->sum('amount');
        $pendingWithdrawals = Withdrawal::whereStatus(Withdrawal::STATUS_PENDING)->sum('amount');
        $lastWithdrawal = Withdrawal::where('status', '!=', Withdrawal::STATUS_CANCELED)->latest()->take(1)->sum('amount');
      
      $data['users'] =  User::latest()->take(2)->get();
      $data['withdw'] = Withdrawal::latest()->take(2)->get();
      $data['depo'] =  Deposit::latest()->take(2)->get();
      $data['login'] = UserActivity::latest()->take(2)->get();


        return view('admin.admin-home', [
            'user' => auth_user(),
            'packages' => $packages,
            'total_users' => $totalUsers,
            'today_users' => $todayUsers,
            'admin_users' => $adminUsers,
            'total_deposits' => $totalDeposits,
            'active_deposits' => $activeDeposits,
            'last_deposit' => $lastDeposit,
            'total_withdrawals' => $totalWithdrawals,
            'pending_withdrawals' => $pendingWithdrawals,
            'last_withdrawal' => $lastWithdrawal,
        ], $data);
    }
}
