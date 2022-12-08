<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */


namespace App\Http\Controllers\Web;

use App\BonusTransfer;
use App\Http\Controllers\Controller;


use App\Models\UserWallet;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\WalletTranfer;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class WalletController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user wallet.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $balance = $request->user()->wallet->amount;
        $bonus = $request->user()->wallet->bonus;

        $breadcrumb = [
            [
                'link' => route('wallet'),
                'title' => 'My Wallet'
            ]
        ];

        return view('wallet.wallet', [
            'balance' => $balance,
            'bonus' => $bonus,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display user wallet.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('transfer'),
                'title' => 'Internal Transfer'
            ]
        ];

        $balance = $request->user()->wallet->transferable_amount;
        $transfer = BonusTransfer::where('user_id', auth_user()->id)->get();


        return view('wallet.transfer', [
            'breadcrumb' => $breadcrumb,
            'balance' => $balance,
            'transfer' => $transfer
        ]);
    }

    public function transfers(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('transfer'),
                'title' => 'Internal Transfer'
            ]
        ];

        $balance = $request->user()->wallet->transferable_amount;
        $transfer = WalletTranfer::where('sender_id', auth_user()->id)->latest()->simplePaginate(10);
        return view('wallet.send_money', [
            'breadcrumb' => $breadcrumb,
            'balance' => $balance,
            'transfers' => $transfer
        ]);
    }
    /**
     * Do transfer
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function VerifyTransfer(Request $request){

        $user = User::where('btc', $request->address)->first();
        if($user){
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'alert' => 'warning',
                'msg' => 'Do you want to transfer $'.$request->amount.' to '.$user->name ." [".$user->email."]",
                'success' => 'success'
            ]);
        }else{
            return response()->json([
                'alert' => 'info',
                'name' => '',
                'msg' => 'No User found with this address'
            ]);
        }
       

     }
    public function doTransfer(Request $request)
    {
        $wallet = $request->user()->wallet->transferable_amount;

        $validate =  validator::make($request->all(), [
            'amount' => 'required|integer|min:0|max:' . $wallet,
            'address' => 'required'
        ]);

        if($validate->fails()){
            $msg = $validate->errors()->first();
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data);
        }
    
        $toUser = User::where('btc', $request->input('address'))->firstOrfail();
        if(!$toUser){
            $msg = 'Request failed, Wallet Address cannot be found';
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data); 
        }
        if($toUser->id == auth()->user()->id){
            $msg = 'Request failed, You cannot tranfer funds to same account';
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data);
            
        }
        UserWallet::reduceAmount($request->user(), $request->input('amount'));
        UserWallet::addAmount($toUser, $request->input('amount'));
        
        $wallets = $request->user()->wallet->amount - $request->input('amount');
        WalletTranfer::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $toUser->id,
            'amount' => $request->input('amount'),
            'sender_balance' => $wallets
        ]);
        $msg = 'Transfer Completed Successfully';
        $data = [
           'msg' => $msg,
           'alert' => 'success',
           'success' => 'success'
          
       ];
       return response()->json($data);
    }

    public function TransferEarnings(Request $request){
       // dd($request->all());
       $this->validate($request, [
            'amounts' => 'required|integer|min:0',
        ]);
      
        $ss = Deposit::where('user_id', $request->user()->id)->sum('amount');
        if($ss < 200){
            Session::flash('msg', 'danger');
            Session::flash('message', 'Request failed, your deposit history is too low for this service');
            return redirect()->back();
           }
            if($request->bonus == 1){
                 $bonus = auth()->user()->wallet->bonus;
                if($bonus >= $request->amounts){
                UserWallet::where('user_id', auth()->user()->id)->update([
                    'bonus'=> $bonus - $request->input('amounts'),
                    'amount' => auth()->user()->wallet->amount + $request->input('amounts'),
                ]);
                $bonz = new BonusTransfer;
                $bonz->type = 'Earnings Bonus';
                $bonz->user_id = auth_user()->id;
                $bonz->amount = $request->amounts;
                $bonz->prev_balance =   $bonus;
                $bonz->avail_balance = $bonus - $request->amounts; 
                $bonz->ref = generate_reference();
                $bonz->save();
                Session::flash('alert', 'success');
                Session::flash('message', 'Transfer Completed Successfully');
               
                return redirect()->back()->with('success', 'Transfer Completed');
                }else{
                    Session::flash('alert', 'error');
                    Session::flash('message', 'Transfer failed, Your Bonus Wallet is less than'.' $'.$request->amounts);
                    return redirect()->back()->with('error', 'Your Bonus Wallet is less than'.' $'.$request->amounts);
                }
               }else {
               $bonus = auth()->user()->wallet->referrals;
               if($bonus >= $request->amounts){
                UserWallet::where('user_id', auth()->user()->id)->update([
                'referrals'=> $bonus - $request->input('amounts'),
                'amount' => auth()->user()->wallet->amount + $request->input('amounts'),
            ]);
            $bonz = new BonusTransfer;
            $bonz->type = 'Referrals Bonus';
            $bonz->user_id = auth_user()->id;
            $bonz->amount = $request->amounts;
            $bonz->prev_balance =   $bonus;
            $bonz->avail_balance = $bonus - $request->amounts; 
            $bonz->ref = generate_reference();
            $bonz->save();
            Session::flash('alert', 'success');
            Session::flash('message', 'Transfer Completed Successfully');
            return redirect()->back()->with('success', 'Transfer Completed');
        }else{
            Session::flash('alert', 'error');
            Session::flash('message', 'Transfer failed, Your Bonus Wallet is less than'.' $'.$request->amounts);
            return redirect()->back()->with('error', 'Your Referral Wallet is less than'.' $'.$request->amounts);
        }
            }
        $bonus = $request->user()->wallet->bonus;
    }

    public function clearNotifications(){
            $notify = UserNotify::where('user_id', auth()->user()->id)->get();
            foreach($notify as $dd){
                $dd->delete();
            }
       
            Session::flash('alert', 'success');
            Session::flash('message', 'Notifications cleared Successfully');
            return back();
    }
}
