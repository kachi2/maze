<?php


namespace App\Http\Controllers\Admin;


use App\Models\Package;
use App\Models\Resource;
use App\Models\Trade;
use App\Notifications\InvestmentCreated;
use App\User;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class InvestmentController extends Controller
{
    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'amount',
        'profit_rate',
        'user_id',
        'resource_id',
        'expires_at',
        'updated_at',
        'duration',
        'payment_period'
    ];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Trade::with(['user', 'resource.package']);

        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('amount', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('profit_rate', 'LIKE', "%$searchString%");
                $query->orWhere('duration', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
            });
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->sortable))
            $query = $query->orderBy($sort[0], $sort[1]);

        if (is_tab('running')) {
            $query->where('expires_at', '>', now());
        } elseif (is_tab('expired')) {
            $query->where('expires_at', '<=', now());
        }

        $investments = $query->paginate();

        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin Panel'
            ],
            [
                'link' => route('admin.investments'),
                'title' => 'Manage Investments'
            ]
        ];

        return view('admin.investments', [
            'investments' => $investments,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Mark the withdraw paid.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function markExpired(Request $request, $id)
    {
        $investment = Trade::findOrFail($id);
        if (!$investment->has_expired) {
            $investment->expires_at = now();
            if (!$investment->save()) {
                return redirect()
                    ->back()
                    ->with('message', 'Unable to mark the investment expired');
            }
        }

        return redirect()
            ->back()
            ->with('message', 'Investment marked expired successfully');
    }
    
     

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addInvestment(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin Panel'
            ],
            [
                'link' => route('admin.investments.add'),
                'title' => 'Add Investment'
            ]
        ];

        $plans = Resource::all();

        return view('admin.add_investment', [
            'breadcrumb' => $breadcrumb,
            'plans' => $plans
        ]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function storeInvestment(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer',
            'package' => 'required|exists:users,id',
            'email' => 'required|email',
            'user_name' => 'required|max:200'
        ]);

        $amount = $request->input('amount');
        $email = $request->input('email');
        $package = $request->input('package');
        $plan = Resource::findOrFail($package);

        $this->validate($request, [
            'amount' => "required|numeric|min:{$plan->min_deposit}|max:{$plan->max_deposit}",
        ]);

        $expireDate = Carbon::now();

        switch ($plan->package->payment_period) {
            case \App\Models\Package::PERIOD_HOURLY:
            case \App\Models\Package::PERIOD_AFTER_SPECIFIED_HOURS:
                $expireDate->addHours($plan->package->duration);
                break;
            case \App\Models\Package::PERIOD_DAILY:
            case \App\Models\Package::PERIOD_WEEKLY:
            case \App\Models\Package::PERIOD_MONTHLY:
            case \App\Models\Package::PERIOD_2_MONTHS:
            case \App\Models\Package::PERIOD_3_MONTHS:
            case \App\Models\Package::PERIOD_6_MONTHS:
            case \App\Models\Package::PERIOD_AFTER_SPECIFIED_DAYS:
                $expireDate->addDays($plan->package->duration);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $username = substr($email, 0, strpos($email, '@'));
            $name = explode(' ', $request->input('user_name'));
            $firstName = $name[0];
            $lastName = isset($name[1]) ? $name[1] : '';
            if (User::whereUsername($username)->exists()) {
                $rand = rand(3, 3);
                $username .= ' ' . $rand;
            }
            $user = new  User([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $email
            ]);

            $user->save();
        }

        $investment = Trade::create([
            'user_id' => $user->id,
            'resource_id' => $plan->id,
            'amount' => $amount,
            'profit_rate' => $plan->profit_rate,
            'expires_at' => $expireDate,
            'duration' => $plan->package->duration,
            'payment_period' => $plan->package->payment_period
        ]);

        try {
            $user->notify(new InvestmentCreated($investment));
        } catch (Exception $exception) {

        }

        return redirect()->back()->with('success', 'Investment added successfully');
    }
}
