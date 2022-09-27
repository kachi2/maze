<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers\Admin;


use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Display testimonies.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Referral::with(['user', 'referrer']);

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

        $todayReferrals = Referral::where('created_at', '>=', today())->count();
        $referralCount = Referral::count();
        $allTimeReferralBonus = Referral::sum('interest');

        $breadcrumb = [
            [
                'link' => route('admin.referrals'),
                'title' => 'Referral'
            ]
        ];

        return view('admin.referrals', [
            'referrals' => $referrals,
            'today_referrals' => $todayReferrals,
            'referral_count' => $referralCount,
            'all_time_referral_bonus' => $allTimeReferralBonus,
            'breadcrumb' => $breadcrumb
        ]);
    }
}
