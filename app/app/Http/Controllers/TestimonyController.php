<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/7/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

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
        $query = Testimony::whereUserId($request->user()->id);

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

        $testimonies = $query->paginate();

        $breadcrumb = [
            [
                'link' => route('testimonies'),
                'title' => 'Testimonies'
            ]
        ];

        return view('testimony.testimonies', [
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
         $testimony = Testimony::whereId($id)->whereUserId($request->user()->id)->firstOrFail();
         $testimony->delete();
         Session::flash('msg', 'success');
         Session::flash('message', 'Testimony deleted successfully'); 
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
                'link' => route('testimonies'),
                'title' => 'Testimonies'
            ],
            [
                'link' => route('testimonies.add'),
                'title' => 'Add Testimony'
            ]
        ];

        return view('testimony.add_testimony', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Store the testimony request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeTestimony(Request $request)
    {
        $this->validate($request, [
            'message' => "required|min:10",
        ]);

        Testimony::create([
            'user_id' => $request->user()->id,
            'user_name' => $request->user()->name,
            'message' => $request->input('message'),
        ]);
        Session::flash('msg', 'success');
        Session::flash('message', 'Testimony added successfully'); 
        
        return redirect()
            ->route('testimonies', 'sort_by=created_at.desc')
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
        $testimony = Testimony::whereId($id)->whereUserId($request->user()->id)->firstOrFail();

        $breadcrumb = [
            [
                'link' => route('testimonies'),
                'title' => 'Testimonies'
            ],
            [
                'link' => route('testimonies.edit', ['id' => $testimony->id]),
                'title' => 'Edit Testimony'
            ]
        ];

        return view('testimony.edit_testimony', [
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
            'message' => "required|min:10",
        ]);

        $testimony = Testimony::whereId($id)->whereUserId($request->user()->id)->firstOrFail();

        if ($message = $request->input('message')) {
            $testimony->message = $message;
        }

        $testimony->save();
        Session::flash('msg', 'success');
        Session::flash('message', 'Testimony updated successfully'); 
      
        return redirect()
            ->back()
            ->with('success', 'Testimony updated successfully');
    }
}
