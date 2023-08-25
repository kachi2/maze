<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    //

    public function Index(){
        return view('agency.campaignIndex');
    }
}
