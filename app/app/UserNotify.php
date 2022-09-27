<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotify extends Model
{
    protected $fillable = [
        'user_id',
        'message'
    ];

    public function User(){

        return $this->belongsTo(User::class);

    }
}
