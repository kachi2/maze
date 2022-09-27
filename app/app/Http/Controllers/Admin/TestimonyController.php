<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/18/2018
 * Time: 1:18 PM
 */

namespace App\Http\Controllers\Admin;


use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{

    /**
     * Array of acceptable sorts.
     *
     * @var array
     */
    protected $sortable = [
        'id',
        'user_name',
        'created_at'
    ];

    /*
     * Fetch all the user.
     *
     * @param string $sort
     * @return LengthAwarePaginator
     */

    public function index(Request $request)
    {
        $query = (new Testimony())->newQuery();

        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $searchString = $request->input('search', "");
                $query->where('message', 'LIKE', "%$searchString%");
                $query->orWhere('user_name', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('id', 'LIKE', "%$searchString%");
                $query->orWhere('user_id', 'LIKE', "%$searchString%");
            });
        }

        if ($request->input('filter_by')) {
            $filter = strtolower($request->input('filter_by'));
            switch ($filter) {
                case 'approved':
                    $query->where('status', Testimony::STATUS_APPROVED);
                    break;
                case 'pending':
                    $query->where('status', Testimony::STATUS_PENDING);
                    break;
            }
        }

        $sort = explode('.', $request->input('sort_by', 'id.desc'));
        if (count($sort) > 0 && in_array($sort[0], $this->sortable))
            $query->orderBy($sort[0], $sort[1]);

        $testimonies = $query->latest()->paginate(50);

        $breadcrumb = [
            [
                'link' => route('admin.testimonies'),
                'title' => 'Testimonies'
            ]
        ];

        return view('admin.testimonies', [
            'testimonies' => $testimonies,
            'breadcrumb' => $breadcrumb
        ]);
    }


    /**
     *  Delete testimony.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyTestimony(Request $request, $id)
    {
        $testimony = Testimony::findOrFail($id);
        $testimony->delete();

        return redirect()->back()->with('success', 'Testimony deleted successfully');
    }


    /**
     *  Edit testimony.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addTestimony(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin'
            ],
            [
                'link' => route('admin.testimonies'),
                'title' => 'Manage Testimonies'
            ],
            [
                'link' => route('admin.testimonies.add'),
                'title' => 'Add Testimony'
            ]
        ];

        return view('admin.add_testimony', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Store the testimony request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTestimony(Request $request)
    {
        $this->validate($request, [
            'message' => "required|min:10",
            'user_name' => "required|min:5",
        ]);

        Testimony::create([
            'user_id' => $request->user()->id,
            'user_name' => $request->input('user_name'),
            'message' => $request->input('message'),
            'status' => Testimony::STATUS_APPROVED
        ]);

        return redirect()
            ->route('admin.testimonies', 'sort_by=created_at.desc')
            ->with('success', 'Testimony added successfully');
    }

    /**
     *  Edit testimony.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editTestimony(Request $request, $id)
    {
        $testimony = Testimony::findOrFail($id);

        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin'
            ],
            [
                'link' => route('admin.testimonies'),
                'title' => 'Manage Testimonies'
            ],
            [
                'link' => route('admin.testimonies.edit', ['id' => $testimony->id]),
                'title' => 'Edit Testimony'
            ]
        ];

        return view('admin.edit_testimony', [
            'testimony' => $testimony,
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Update the testimony request.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateTestimony(Request $request, $id)
    {
        $this->validate($request, [
            'message' => "nullable|min:10",
            'user_name' => "nullable|min:5",
        ]);

        $testimony = Testimony::findOrFail($id);

        if ($message = $request->input('message')) {
            $testimony->message = $message;
        }

        if ($userName = $request->input('user_name')) {
            $testimony->user_name = $userName;
        }

        $testimony->save();

        return redirect()
            ->back()
            ->with('success', 'Testimony updated successfully');
    }


    /**
     *  Mark the testimony Approved.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function markApproved(Request $request, $id)
    {
        $testimony = Testimony::findOrFail($id);
        if ($testimony->status == Testimony::STATUS_PENDING) {
            $testimony->status = Testimony::STATUS_APPROVED;
            if (!$testimony->save()) {
                return redirect()
                    ->back()
                    ->with('error', 'Unable to mark the testimony Approved');
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Testimony Approved successfully');
    }

    /**
     *  Mark the testimony Dispproved.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function markDisapproved(Request $request, $id)
    {
        $testimony = Testimony::findOrFail($id);
        if ($testimony->status == Testimony::STATUS_APPROVED) {
            $testimony->status = Testimony::STATUS_PENDING;
            if (!$testimony->save()) {
                return redirect()
                    ->back()
                    ->with('error', 'Unable to mark the testimony Disapproved');
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Testimony Disapproved successfully');
    }
}
