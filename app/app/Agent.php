<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent  extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = ['ref_code', 'name', 'email', 'password', 'remember_token', 'phone', 'city', 'state', 'country', 'working_hours', 'pay_day', 'email_verify', 'doc', 'address', 'wallet_address', 'payment_method', 'next_pay', 'prev_balance', 'avail_balance', 'total', 'is_accepted', 'is_admin', 'last_login', 'login_counts', 'login_ip'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'bool'
    ];
    
}
