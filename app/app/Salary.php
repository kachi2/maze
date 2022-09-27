<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //

    protected $table = "salaries";
    
    protected $fillables = ['agent_id', 'amount', 'status', 'payment_method', 'wallet_address', 'is_approved', 'avail_balance', 'prev_balance', 'total'];
}
