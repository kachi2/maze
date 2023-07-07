<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketList extends Model
{
    //

    protected $fillable = ['name', 'symbol', 'image', 'current_price', 'price_change_24h', 'price_change_percentage_24h', 'market_cap_change_24h', 'market_cap_change_percentage_24h', 'market_cap'];
}
