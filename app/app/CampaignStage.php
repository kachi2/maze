<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignStage extends Model
{
    //

    protected $table = "campaign_stages";
    protected $fillable = ['agent_id', 'campaign_id', 'referrals', 'status'];

    public function campaign(){
        return $this->belongsTo(AffiliateCampaign::class, 'campaign_id', 'id');
    }
}
