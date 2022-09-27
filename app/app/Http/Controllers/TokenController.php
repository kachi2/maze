<?php
/**
 * Created by PhpStorm.
 * User: Hassan Gani
 * Date: 5/17/19
 * Time: 5:03 PM
 */

namespace App\Http\Controllers;


use App\Models\BitcoinAddress;
use App\Models\Token;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TokenController extends Controller
{

    /**
     * Display user token.
     *
     * @param Request $request
     * @param $id
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {

        $token = Token::whereUseBy($request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->first();

        $breadcrumb = [
            [
                'link' => route('token'),
                'title' => 'Token'
            ]
        ];

        return view('token.token', [
            'breadcrumb' => $breadcrumb,
            'token' => $token
        ]);
    }

    /**
     * Update the user's wallet information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate(Request $request)
    {
        $user = $request->user();

        $token = Token::whereNull('use_by')->where('type', $request->input('type', Token::TYPE_BITWALLET))->first();

        if ($token) {
            $token->use_by = $user->id;
            $token->save();
            return redirect()
                ->back()
                ->with('success', 'Mining token generated successfully');
        }


        return redirect()
            ->back()
            ->with('error', 'No mining Token at the Moment, contact Support');
    }
}