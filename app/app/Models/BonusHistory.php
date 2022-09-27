<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BonusHistory
 *
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BonusHistory whereUserId($value)
 * @mixin \Eloquent
 */
class BonusHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'user_id',
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'user_id' => 'int'
    ];

    /**
     * Get the User for the bonus history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
