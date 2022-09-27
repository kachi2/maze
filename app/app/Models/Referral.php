<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Referral
 *
 * @property int $id
 * @property int $user_id
 * @property int $referrer_id
 * @property float $interest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $has_deposit
 * @property-read \App\User $referrer
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral whereReferrerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referral whereUserId($value)
 * @mixin \Eloquent
 */
class Referral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref',
        'user_id',
        'interest',
        'referrer_id',
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'interest' => 'double'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'has_deposit'
    ];

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getHasDepositAttribute()
    {
        return Deposit::whereUserId($this->user_id)->exists();
    }

    /**
     * Get the User for the referral.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the referrer User.
     */
    public function referrer()
    {
        return $this->belongsTo(User::class);
    }
}
