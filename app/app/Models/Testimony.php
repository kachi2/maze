<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Testimony
 *
 * @property int $id
 * @property int $user_id
 * @property string $user
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Testimony whereUserId($value)
 * @mixin \Eloquent
 */
class Testimony extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'user_id',
        'status',
        'user_name'
    ];

    /**
     * Get the User for the Testimony.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
