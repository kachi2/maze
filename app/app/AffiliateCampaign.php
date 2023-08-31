<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateCampaign extends Model
{
    //

    protected $table = "affiliate_campaigns";
    protected $fillables = ['name', 'slug', 'description','commission', 'number_of_ref', 'reg_comm'];
}
