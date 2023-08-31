<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateCommission extends Model
{
    //

    protected $table = "affiliate_commissions";
    protected $fillables = ['agent_id', 'user_id', 'amount', 'float_balance', 'avail_balance', 'source'];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
