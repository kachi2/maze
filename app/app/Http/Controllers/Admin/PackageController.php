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
use App\Models\Plan;
use App\Models\RateHistory;
use App\Models\Resource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PackageController extends Controller
{

    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $depositSortable = [
        'ref',
        'amount',
        'profit_rate',
        'user_id',
        'plan_id',
        'expires_at',
        'updated_at',
        'duration',
        'payment_period',
        'payment_method',
        'status'
    ];

    /**
     * Show the admin packages page.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = new Package();

        if ($request->input('search')) {
            $searchString = $request->get('search');
            $query = $query->where(function ($query) use ($searchString) {
                $query->where('id', 'LIKE', "%$searchString%");
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });
        }

        $allCount = $query->count();

        $packages = $query->get();

        $breadcrumb = [
            [
                'link' => route('admin.packages'),
                'title' => 'Manage Packages'
            ]
        ];

        return view('admin.packages', [
            'breadcrumb' => $breadcrumb,
            'packages' => $packages,
            'all_count' => $allCount,
        ]);
    }

    /**
     *  Edit package.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function showPackage(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $breadcrumb = [
            [
                'link' => route('admin.packages'),
                'title' => 'Manage Packages'
            ],
            [
                'link' => route('admin.packages.show', ['id' => $package->id]),
                'title' => 'Package : ' . $package->name
            ]
        ];

        return view('admin.show-package', [
            'package' => $package,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Show the admin plans page.
     *
     * @param Request $request
     * @return Response
     */
    public function showPlans(Request $request)
    {
        $query = Plan::with('package');

        if ($request->input('search')) {
            $searchString = $request->get('search');
            $query = $query->where(function ($query) use ($searchString) {
                $query->where('id', 'LIKE', "%$searchString%");
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });
        }

        $allCount = $query->count();

        $plans = $query->paginate();

        $breadcrumb = [
            [
                'link' => route('admin.packages'),
                'title' => 'Manage Packages'
            ],
            [
                'link' => route('admin.plans'),
                'title' => 'Manage Plans'
            ]
        ];

        return view('admin.plans', [
            'breadcrumb' => $breadcrumb,
            'plans' => $plans,
            'all_count' => $allCount,
        ]);
    }

    /**
     *  Edit plan.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function showPlan(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $packages = Package::all();
        $query = Deposit::wherePlanId($id);

        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('amount', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('profit_rate', 'LIKE', "%$searchString%");
                $query->orWhere('duration', 'LIKE', "%$searchString%");
                $query->orWhere('payment_method', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
                $query->orWhere('ref', 'LIKE', "%$searchString%");
            });
        }

        if ($request->input('filter_by')) {
            $filter = strtolower($request->input('filter_by'));
            switch ($filter) {
                case 'active':
                    $query->where('status', Deposit::STATUS_ACTIVE);
                    break;
                case 'completed':
                    $query->where('status', Deposit::STATUS_COMPLETED);
                    break;
                case 'canceled':
                    $query->where('status', Deposit::STATUS_CANCELED);
                    break;
            }
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->depositSortable))
            $query->orderBy($sort[0], $sort[1]);

        $deposits = $query->paginate();

        $breadcrumb = [
            [
                'link' => route('admin.packages'),
                'title' => 'Manage Packages'
            ],
            [
                'link' => route('admin.plans.show', ['id' => $plan->id]),
                'title' => 'Plan : ' . $plan->name
            ]
        ];

        return view('admin.show-plan', [
            'plan' => $plan,
            'deposits' => $deposits,
            'packages' => $packages,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Edit plan.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function addPackage(Request $request)
    {

        $breadcrumb = [
            [
                'link' => route('admin.packages'),
                'title' => 'Manage Packages'
            ],
            [
                'link' => route('admin.packages.add'),
                'title' => 'Add Package'
            ]
        ];

        return view('admin.add-package', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Change the package details.
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws ValidationException
     */
    public function storePackage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'payment_period' => 'required',
            'duration' => 'required',
            'desc' => 'required',
            'plans.*.name' => 'required_with:plans.*.min_deposit,plans.*.max_deposit,plans.*.profit_rate',
            'plans.*.min_deposit' => 'required_with:plans.*.name,plans.*.max_deposit,plans.*.profit_rate',
            'plans.*.max_deposit' => 'required_with:plans.*.name,plans.*.min_deposit,plans.*.profit_rate',
            'plans.*.profit_rate' => 'required_with:plans.*.name,plans.*.max_deposit,plans.*.min_deposit',
        ]);

        $package = Package::create([
            'name' => $request->input('name'),
            'payment_period' => $request->input('payment_period'),
            'duration' => $request->input('duration'),
            'desc' => $request->input('desc'),
        ]);

        foreach ($request->input('plans') as $plan) {
            if (isset($plan['name']) && !empty(isset($plan['name']))) {
                $resource = Plan::create([
                    'name' => $plan['name'],
                    'min_deposit' => $plan['min_deposit'],
                    'max_deposit' => $plan['max_deposit'],
                    'package_id' => $package->id,
                    'profit_rate' => $plan['profit_rate']
                ]);
            }
        }

        return redirect()
            ->route('admin.packages.edit', ['id' => $package->id])
            ->with('success', 'Package added successfully');
    }

    /**
     *  Edit package.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editPackage(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $breadcrumb = [
            [
                'link' => route('admin.packages'),
                'title' => 'Manage Packages'
            ],
            [
                'link' => route('admin.packages.edit', ['id' => $package->id]),
                'title' => 'Edit Package : ' . $package->name
            ]
        ];

        return view('admin.edit-package', [
            'package' => $package,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Change the package details.
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws ValidationException
     */
    public function updatePackage(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'payment_period' => 'required',
            'duration' => 'required',
            'desc' => 'required',
        ]);

        $package->name = $request->input('name');
        $package->payment_period = $request->input('payment_period');
        $package->duration = $request->input('duration');
        $package->desc = $request->input('desc');

        $package->save();

        return redirect()
            ->back()
            ->with('success', 'Package details updated successfully');
    }

    /**
     *  Edit plan.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function addPlan(Request $request)
    {

        $packages = Package::all();

        $breadcrumb = [
            [
                'link' => route('admin.plans'),
                'title' => 'Manage Plans'
            ],
            [
                'link' => route('admin.plans.add'),
                'title' => 'Add Plan'
            ]
        ];

        return view('admin.add_plan', [
            'packages' => $packages,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Change the plan details.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function storePlan(Request $request)
    {
        session()->flash('is-adding-plan', true);

        $this->validate($request, [
            'name' => 'required',
            'min_deposit' => 'required|numeric',
            'max_deposit' => 'required|numeric',
            'package' => 'required|exists:packages,id',
            'profit_rate' => 'required',
        ]);

        $resource = Plan::create([
            'name' => $request->input('name'),
            'min_deposit' => $request->input('min_deposit'),
            'max_deposit' => $request->input('max_deposit'),
            'package_id' => $request->input('package'),
            'profit_rate' => $request->input('profit_rate'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Plan added successfully');
    }

    /**
     *  Edit plan.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editPlan(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $packages = Package::all();

        $breadcrumb = [
            [
                'link' => route('admin.plans'),
                'title' => 'Manage Plans'
            ],
            [
                'link' => route('admin.plans.edit', ['id' => $plan->id]),
                'title' => 'Edit Plan : ' . $plan->name
            ]
        ];

        return view('admin.edit_plan', [
            'plan' => $plan,
            'packages' => $packages,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     *  Change the plan details.
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws ValidationException
     */
    public function updatePlan(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        session()->flash('is-editing-plan', true);
        session()->flash('editing-plan-id', $plan->id);
        $this->validate($request, [
            'name' => 'required',
            'min_deposit' => 'required|numeric',
            'max_deposit' => 'required|numeric',
            'profit_rate' => 'required',
        ]);

        $plan->name = $request->input('name');
        $plan->min_deposit = $request->input('min_deposit');
        $plan->max_deposit = $request->input('max_deposit');
        $plan->profit_rate = $request->input('profit_rate');

        $plan->save();

        return redirect()
            ->back()
            ->with('success', 'Plan details updated successfully');
    }

    /**
     *  Delete plan.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroyPlan(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->back()->with('success', 'Plan deleted successfully');
    }

    /**
     *  Delete plan.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroyPackage(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->back()->with('success', 'Package deleted successfully');
    }
}
