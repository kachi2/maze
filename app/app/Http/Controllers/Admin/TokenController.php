<?php
/**
 * Created by PhpStorm.
 * User: Hassan Gani
 * Date: 5/17/19
 * Time: 5:03 PM
 */

namespace App\Http\Controllers\Admin;


use App\Models\Token;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TokenController extends Controller
{

    /**
     * Display user token.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $query = new Token();

        if ($request->input('search')) {
            $searchString = $request->get('search');
            $query = $query->where(function ($query) use ($searchString) {
                $query->where('id', 'LIKE', "%$searchString%");
                $query->orWhere('token', 'LIKE', "%$searchString%");
            });
        }

        $allCount = $query->count();

        $tokens = $query->latest()->paginate(50);

        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin Panel'
            ],
            [
                'link' => route('admin.tokens'),
                'title' => 'Manage Tokens'
            ]
        ];

        return view('admin.tokens', [
            'breadcrumb' => $breadcrumb,
            'tokens' => $tokens,
            'all_count' => $allCount,
        ]);
    }

    /**
     *  Edit token.
     *
     * @param Request $request
     * @param $id
     * @return Factory|View
     */
    public function addToken(Request $request)
    {
        $breadcrumb = [
            [
                'link' => route('admin.home'),
                'title' => 'Admin'
            ],
            [
                'link' => route('admin.tokens'),
                'title' => 'Manage Tokens'
            ],
            [
                'link' => route('admin.tokens.add'),
                'title' => 'Add Token'
            ]
        ];

        return view('admin.add-token', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Store the token request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeToken(Request $request)
    {
        $this->validate($request, [
            'token' => "required|min:7",
            'type' => "required|min:1|max:2",
        ]);

        Token::create([
            'token' => $request->input('token'),
            'type' => $request->input('type')
        ]);

        return redirect()
            ->back()
            ->with('success', 'Token added successfully');
    }

    /**
     *  Delete token.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request, $id)
    {
        $token = Token::findOrFail($id);
        $token->delete();

        return redirect()->back()->with('success', 'Token deleted successfully');
    }

}