<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentActivity extends Model
{
    //

    protected $fillable = [

        'agent_id', 'last_login', 'login_ip', 'browser'
    ];
}
