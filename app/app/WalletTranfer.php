<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTranfer extends Model
{
    //

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'amount',
        'sender_balance'
    ];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
     public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
