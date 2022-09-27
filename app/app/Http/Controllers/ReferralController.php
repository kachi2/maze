<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers;


use App\Models\Referral;
use App\Models\Testimony;
use App\TaskCampaign;
use App\Models\Package;
use App\Models\Plan;
use Illuminate\Support\Carbon;
use App\Models\Deposit;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ReferralController extends Controller
{

    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'ref',
        'id',
        'user_id',
        'referrer_id',
        'interest',
        'created_at'
    ];

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
     * Display testimonies.
     *
     * @param Request $request
     * @return Response
     */

    
     public function BonusInvest(Request $request, $id = null)
     {
         $task = TaskCampaign::where('id', $request->task_id)->first();
         TaskCampaign::where('id', $task->id)->update([
             'is_clicked' => 1,
             'metrics' => 10
         ]);
        $id = decrypt($id);
         $plans = Plan::with('package')->get();
         $packages = Package::with('plans')->get();
         $balance = $request->user()->wallet->amount;
         $bonus = $request->user()->wallet->bonus;
         $investment = Deposit::where(['plan_id' => $id, 'user_id'=>auth()->user()->id])->take(5)->get();
 
         //adding more fields
 
 
         $breadcrumb = [
             [
                 'link' => route('deposits'),
                 'title' => 'Deposits'
             ],
             [
                 'link' => route('deposits.invest', ['id' => $id]),
                 'title' => 'Invest'
             ]
         ];
 
         if ($id == null) {
             return view('mobile.packages', [
                 'breadcrumb' => $breadcrumb,
                 'plans' => $plans,
                 'packages' => $packages,
                 'balance' => $balance,
                 'bonus' => $bonus
             ]);
         }
         $plan = Plan::findOrFail($id);
         return view('mobile.invest', [
             'breadcrumb' => $breadcrumb,
             'plan' => $plan,
             'plans' => $plans,
             'balance' => $balance,
             'bonus' => $bonus,
             'investment' => $investment 
         ]);
     }
 

    public function index(Request $request)
    {
        $query = Referral::with(['user', 'referrer']);
        $query->where('referrer_id', $request->user()->id);

        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('interest', 'LIKE', "%$searchString%");
                $query->orWhere('user_id', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
                $query->orWhere('ref', 'LIKE', "%$searchString%");
            });
        }

        if ($request->has('sort_by')) {
            $sort = explode('.', $request->input('sort_by'));
            if (count($sort) > 0 && in_array($sort[0], $this->sortable))
                $query = $query->orderBy($sort[0], $sort[1]);
        }

        $referrals = $query->get();

        $todayReferrals = Referral::whereUserId($request->user()->id)->where('created_at', '>=', today())->count();

        $breadcrumb = [
            [
                'link' => route('referral'),
                'title' => 'Referral'
            ]
        ];

        return view('mobile.referral', [
            'referrals' => $referrals,
            'today_referrals' => $todayReferrals,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display refer.
     *
     * @param Request $request
     * @return Response
     */
    public function refer(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('refer'),
                'title' => 'Refer'
            ]
        ];

        return view('referral.refer', [
            'ref_url' => $request->user()->ref_url,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Display refer.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
    }
}
