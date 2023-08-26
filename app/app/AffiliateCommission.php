<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateCommission extends Model
{
    //

    protected $table = "affiliate_commissions";
    protected $fillables = ['name', 'slug', 'description','commission', 'number_of_ref'];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
