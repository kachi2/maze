<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $breadcrumb = [
            [
                'title' => 'Admin panel',
                'link' => route('admin.home')
            ],
            [
                'title' => 'Setting Management',
                'link' => route('admin.setting')
            ]
        ];

        return view('admin.settings', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Update the settings.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'nullable|max:225|min:3',
            'description' => 'nullable',
            'registration' => 'nullable|between:0,1',
            'login' => 'nullable|between:0,1',
            'automatic_withdrawal' => 'nullable|between:0,1',
            'referral_interest_percent' => 'numeric',
        ]);

        if ($request->input('title')) {
            Setting::setItem('app.name', $request->input('title'));
        }

        if ($request->input('description')) {
            Setting::setItem('app.description', $request->input('description'));
        }

        if ($request->has('registration')) {
            Setting::setItem('app.registration', $request->input('registration'));
        }

        if ($request->has('login')) {
            Setting::setItem('app.login', $request->input('login'));
        }

        if ($request->has('automatic_withdrawal')) {
            Setting::setItem('app.automatic_withdrawal', $request->input('automatic_withdrawal'));
        }

        if ($request->input('coinpayments_merchant_id')) {
            Setting::setItem('coinpayments.merchant_id', $request->input('coinpayments_merchant_id'));
        }

        if ($request->input('coinpayments_public_key')) {
            Setting::setItem('coinpayments.public_key', $request->input('coinpayments_public_key'));
        }

        if ($request->input('coinpayments_private_key')) {
            Setting::setItem('coinpayments.private_key', $request->input('coinpayments_private_key'));
        }

        if ($request->input('coinpayments_ipn_secret')) {
            Setting::setItem('coinpayments.ipn_secret', $request->input('coinpayments_ipn_secret'));
        }

        if ($request->input('perfectmoney_account_id')) {
            Setting::setItem('perfectmoney.account_id', $request->input('perfectmoney_account_id'));
        }

        if ($request->input('perfectmoney_passphrase')) {
            Setting::setItem('perfectmoney.passphrase', $request->input('perfectmoney_passphrase'));
        }

        if ($request->input('perfectmoney_marchant_id')) {
            Setting::setItem('perfectmoney.marchant_id', $request->input('perfectmoney_marchant_id'));
        }

        if ($request->input('perfectmoney_alternate_passphrase')) {
            Setting::setItem('perfectmoney.alternate_passphrase', $request->input('perfectmoney_alternate_passphrase'));
        }

        if ($request->input('referral_interest_percent')) {
            Setting::setItem('referral.interest_percent', $request->input('referral_interest_percent'));
        }

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
