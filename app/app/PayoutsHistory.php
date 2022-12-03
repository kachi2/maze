<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayoutsHistory extends Model
{
    protected $fillable = [

        'ref', 'amount', 'prev_balance', 'avail_balance', 'user_id'
    ];
}
