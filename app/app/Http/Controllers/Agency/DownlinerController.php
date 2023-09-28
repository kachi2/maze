<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DownlinerController extends Controller
{
    //

    public function __construct()
    {
        
        return $this->middleware('agentMiddleware');
    }

    public function DownlinerIndex(){
        $data['direct_ref'] = User::where(['referral_id' => agent_user()->ref_code, ['sponsor_id', '==', null], ['sponsor_two', '==', null]])->get();
        $data['indirect_ref'] = User::where(['referral_id' => agent_user()->ref_code, ['sponsor_id', '!=', null], ['sponsor_two', '==', null]])->get();
        $data['sponsor_two'] = User::where(['referral_id' => agent_user()->ref_code, ['sponsor_id', '!=', null], ['sponsor_two', '!=', null]])->get();
        return view('agency.downlinerIndex', $data);
    }

}
