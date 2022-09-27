<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers\Admin;


use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{

    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'ref',
        'id',
        'amount',
        'profit',
        'created_at'
    ];


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Payout::with(['plan', 'user']);

        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('amount', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
            });
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->sortable))
            $query = $query->orderBy($sort[0], $sort[1]);

        $payouts = $query->latest()->paginate(1000);

        $breadcrumb = [
            [
                'link' => route('admin.payouts'),
                'title' => 'Payouts'
            ]
        ];

        return view('admin.payouts', [
            'payouts' => $payouts,
            'breadcrumb' => $breadcrumb
        ]);
    }

}
