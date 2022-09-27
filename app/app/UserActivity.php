<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [

        'user_id',
        'login_ip',
        'last_login'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
