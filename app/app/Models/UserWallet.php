<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserWallet
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property float $referrals
 * @property float $bonus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $total_amount
 * @property-read string $transferable_amount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereReferrals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserWallet whereUserId($value)
 * @mixin \Eloquent
 */
class UserWallet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'user_id',
        'referrals',
        'bonus'
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'referrals' => 'double',
        'bonus' => 'double'
    ];

    public static function addAmount($user, $amount)
    {
        $userWallet = (new UserWallet)->whereUserId($user->id)->first();
        if (!$userWallet) {
            $userWallet = UserWallet::create([
                'user_id' => $user->id,
                'amount' => $amount
            ]);
        } else {
            $userWallet->amount = $userWallet->amount + $amount;
            $userWallet->save();
        }

        $user->wallet = $userWallet;
    }

    public static function addBonus($user, $amount)
    {
        $userWallet = (new UserWallet)->whereUserId($user->id)->first();
        if (!$userWallet) {
            $userWallet = UserWallet::create([
                'user_id' => $user->id,
                'bonus' => $amount,
                'amount' => 0
            ]);
        } else {
            $userWallet->bonus = $userWallet->bonus + $amount;
            $userWallet->save();
        }

        $user->wallet = $userWallet;
    }

    public static function reducePayoutAmount($user, $amount)
    {
        $userWallet = (new UserWallet)->whereUserId($user->id)->first();
        if (!$userWallet) {
            $userWallet = UserWallet::create([
                'user_id' => $user->id,
                'amount' => -$amount
            ]);
        } else {
            $userWallet->amount = $userWallet->amount - $amount;
            $userWallet->save();
        }

        $user->wallet = $userWallet;
    }

    public static function reduceAmount($user, $amount)
    {
        $userWallet = (new UserWallet)->whereUserId($user->id)->firstOrFail();

        $amount = self::removeFromBonus($userWallet, $amount);

        if ($amount > 0) {
            $amount = self::removeFromReferrals($userWallet, $amount);
        }

        if ($amount > 0) {
            $amount = self::removeFromBaseAmount($userWallet, $amount);
        }

        $userWallet->save();

        $user->wallet = $userWallet;
    }

    /**
     * Get the profile first name attribute.
     *
     * @return string
     */
    public function getTotalAmountAttribute()
    {
        return $this->amount + $this->referrals + $this->bonus;
    }

    /**
     * Get the profile first name attribute.
     *
     * @return string
     */
    public function getTransferableAmountAttribute()
    {
        return $this->amount;
    }

    public static function removeFromBonus(UserWallet $userWallet, $amount)
    {
        $bonus = $userWallet->bonus;
        if ($bonus >= $amount) {
            $userWallet->bonus = $bonus - $amount;
            return 0;
        }

        $userWallet->bonus = 0;

        return $amount - $bonus;
    }

    public static function removeFromReferrals(UserWallet $userWallet, $amount)
    {
        $referrals = $userWallet->referrals;
        if ($referrals >= $amount) {
            $userWallet->referrals = $referrals - $amount;
            return 0;
        }

        $userWallet->referrals = 0;

        return $amount - $referrals;
    }


    public static function removeFromBaseAmount(UserWallet $userWallet, $amount)
    {
        $baseAmount = $userWallet->amount;
        if ($baseAmount >= $amount) {
            $userWallet->amount = $baseAmount - $amount;
            return 0;
        }

        $userWallet->amount = 0;

        return $amount - $baseAmount;
    }
}
