<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers;


use App\Models\UserWallet;
use App\User;
use App\UserNotify;
use Illuminate\Support\Facades\Session;
use App\WalletTranfer;
use Illuminate\Http\Request;
use App\Models\Deposit;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\TaskCampaign;

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
        $tranfers = WalletTranfer::where('sender_id', $request->user()->id)->orwhere( 'receiver_id',$request->user()->id)->latest()->paginate(5);
        $sent = WalletTranfer::where('sender_id', $request->user()->id)->sum('amount');
        $received = WalletTranfer::where('receiver_id', $request->user()->id)->sum('amount');

        return view('mobile.transfer', [
            'breadcrumb' => $breadcrumb,
            'balance' => $balance,
            'transfers' => $tranfers,
            'sent' => $sent,
            'received' => $received
        ]);
    }

    /**
     * Do transfer
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function doTransfer(Request $request)
    {
        $wallet = $request->user()->wallet->transferable_amount;
        $ss = Deposit::where('user_id', $request->user()->id)->sum('amount');
        if($ss < 200){
            // Session::flash('msg', 'danger');
            // Session::flash('message', 'Request failed, your deposit history is too low for this service');
            // return redirect()->back();
            $msg = 'Request failed, your deposit history is too low for this service';
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data);
           }
       $validate =  validator::make($request->all(), [
            'amount' => 'required|integer|max:' . $wallet,
            'username' => 'required|exists:users',
        ]);

        if($validate->fails()){
            $msg = $validate->errors()->first();
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data);
        }

        $toUser = User::where('username', $request->input('username'))->firstOrfail();
        if($toUser->id == auth()->user()->id){
            // Session::flash('msg', 'danger');
            // Session::flash('message', 'You cannot tranfer funds to same account');
            // return redirect()->back();
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
        // Session::flash('msg', 'success');
        // Session::flash('message', 'Transfer Completed Successfully');

        // return redirect()->back()->with('success', 'Fund transferred successfully');
        $msg = 'Transfer Completed Successfully';
        $data = [
           'msg' => $msg,
           'alert' => 'success'
       ];
       return response()->json($data);
    }


    public function Bonus(){
        $task = TaskCampaign::where('user_id', auth_user()->id)->get();
        return view(
            'mobile.bonus',[
                'tasks' => $task
        ]);
     }


    public function TransferEarnings(Request $request){
        $bonus = auth()->user()->wallet->bonus;

        $validate =  validator::make($request->all(), [
            'amounts' => 'required|integer|min:0',
        ]);

        if($validate->fails()){
            $msg = $validate->errors()->first();
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
           return response()->json($data);
        }
            if($request->bonus == 1){
                 $bonus = auth()->user()->wallet->bonus;
                if($bonus >= $request->amounts){
                $userBonus = UserWallet::where('user_id', auth()->user()->id)->update([
                    'bonus'=> $bonus - $request->input('amounts'),
                    'amount' => auth()->user()->wallet->amount + $request->input('amounts'),
                ]);
                // Session::flash('alert', 'success');
                // Session::flash('message', 'Transfer Completed Successfully');
                // return redirect()->back()->with('success', 'Transfer Completed');

                $msg = 'Transfer Completed Successfully';
                $data = [
                   'msg' => $msg,
                   'alert' => 'success'
               ];
               return response()->json($data);
                }else{
                    $msg = 'Transfer failed, Your Bonus Wallet is less than'.' $'.$request->amounts;
                    $data = [
                       'msg' => $msg,
                       'alert' => 'error'
                   ];
                    return response()->json($data);
                   }
               }else {
               $bonuss = auth()->user()->wallet->referrals;
               if($bonuss >= $request->amounts){
                 UserWallet::where('user_id', auth()->user()->id)->update([
                'referrals'=> $bonuss - $request->input('amounts'),
                'amount' => auth()->user()->wallet->amount + $request->input('amounts'),
            ]);
            $msg = 'Transfer Completed Successfully';
            $data = [
               'msg' => $msg,
               'alert' => 'success'
           ];
            return response()->json($data);
        }else{
            $msg = 'Transfer failed, Your Bonus Wallet is less than'.' $'.$request->amounts;
            $data = [
               'msg' => $msg,
               'alert' => 'error'
           ];
            return response()->json($data);
        }
               }
      //  $user_balance = $bonus = $request->user()->wallet->bonus;
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
