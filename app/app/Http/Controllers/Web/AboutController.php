<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\MarketList;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
       $resp = MarketList::get();
        return view('about-us')
        ->with('coins', $resp);
    }
}
