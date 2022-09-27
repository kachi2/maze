<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payout
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property float $amount
 * @property float $profit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan $plan
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payout whereUserId($value)
 * @mixin \Eloquent
 */
class Payout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref',
        'amount',
        'profit',
        'user_id',
        'plan_id',
        'deposit_id',
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'profit' => 'double'
    ];

    /**
     * Get the User for the payout.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Deposit for the payout.
     */
    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    /**
     * Get the Plan for the payout.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
