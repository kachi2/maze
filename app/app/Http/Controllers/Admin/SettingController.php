<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WalletAddress;
use Intervention\Image\Facades\Image;
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
            'name' => 'unique:wallet_addresses'
        ]);

        if ($request->input('title')) {
            Setting::setItem('app.name', $request->input('title'));
        }

        if ($request->input('description')) {
            Setting::setItem('app.description', $request->input('description'));
        }

        if($request->name){
            $address = new WalletAddress;
            $address->name = $request->name;
            $address->address = $request->address;
            if($request->barcode){
                $image = $request->file('barcode');
                $file = $image->getClientOriginalExtension();
                $ex = time().'.'.$file;
                Image::make($request->file('barcode'))->resize(295,298)->save('mobile/images/'.$ex);
                $address->barcode = $ex;
            }
        $address->save();

        \Session::flash('msg', 'success');
        \Session::flash('message', 'Settings Updated Successfully'); 
        }
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
