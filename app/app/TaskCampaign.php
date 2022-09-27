<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskCampaign extends Model
{
    //

    protected $fillable = [
        'user_id', 'plan_id', 'name', 'rules', 'reward', 'image', 'is_completed', 'is_clicked', 'metrics', 'admin_approval', 'expires'
    ];
}
