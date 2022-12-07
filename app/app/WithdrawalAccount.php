<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawalAccount extends Model
{
    //

    protected $fillable = [

        'user_id', 'type', 'address', 'currency'
    ];
}
