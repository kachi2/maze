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
use App\WalletAddress;
use App\WalletDeposit;
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

        $Deposits = Deposit::where('payment_method', '!=', 'wallet')->sum('amount');
        $wallet = WalletDeposit::where('status', 1)->sum('amount');
        $totalDeposits =  $Deposits + $wallet;
        $activeDeposits = Deposit::whereStatus(0)->sum('amount');
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
            'total_investment' => $totalDeposits,
            'active_deposits' => $activeDeposits,
            'last_deposit' => $lastDeposit,
            'total_withdrawals' => $totalWithdrawals,
            'pending_withdrawals' => $pendingWithdrawals,
            'last_withdrawal' => $lastWithdrawal,
        ], $data);
    }

    public function WalletAddresses(){
        return view('admin.wallet')
        ->with('wallets', WalletAddress::latest()->get());
    }
 
    public function WalletAddressDelete($id){
        $wallet = WalletAddress::findorfail(decrypt($id));
        $wallet->delete();
        \Session::flash('msg', 'success');
        \Session::flash('message', 'Wallet Deleted Successfully'); 
        return back();
  
    }
}
