<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DownlinerController extends Controller
{
    //

    public function DownlinerIndex(){
        $data['direct_ref'] = User::where('ref_code',agent_user()->ref_code)->get();
        $data['indirect_ref'] = User::where('sponsor_id', agent_user()->ref_code)->get();
        $data['sponsor_two'] = User::where('sponsor_two', agent_user()->ref_code)->get();
        return view('agency.downlinerIndex', $data);
    }



}
