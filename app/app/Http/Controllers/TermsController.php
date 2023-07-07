<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\MarketList;
class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $resp = MarketList::get();
        return view('terms')->with('coins', $resp);
    }


    public function Privacy()
    {
        $resp = MarketList::get();
        return view('privacy')->with('coins', $resp);
    }
}
