<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentActivity extends Model
{
    //
    protected $fillable = ['agent_id', 'login_ip', 'browser', 'last_login'];
}
