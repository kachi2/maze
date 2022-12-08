<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusTransfer extends Model
{
    //

    protected $fillable = [
            'user_id', 'type', 'amount', 'ref', 'prev_balance', 'avail_balance'
    ];
}
