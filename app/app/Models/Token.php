<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Token
 *
 * @property int $id
 * @property string $token
 * @property int $type
 * @property int|null $use_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $is_bitwallet
 * @property-read bool $is_mycelium
 * @property-read mixed $qr_code
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUseBy($value)
 * @mixin \Eloquent
 */
class Token extends Model
{

    const TYPE_BITWALLET = 1;
    const TYPE_MYCELIUM = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'use_by',
        'type'
    ];

    public function getQrCodeAttribute()
    {
        return 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=' . urlencode($this->token);
    }

    /**
     * Get the User for the referral.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'use_by');
    }

    /**
     * Get check is bittwallet attribute.
     *
     * @return bool
     */
    public function getIsBitwalletAttribute()
    {
        return $this->type == self::TYPE_BITWALLET;
    }

    /**
     * Get check is bittwallet attribute.
     *
     * @return bool
     */
    public function getIsMyceliumAttribute()
    {
        return $this->type == self::TYPE_MYCELIUM;
    }

    /**
     * Get check is bittwallet attribute.
     *
     * @return bool
     */
    public function getTypeNameAttribute()
    {
        return $this->type == self::TYPE_BITWALLET ? 'Bitwallet' : 'Nycelium';
    }
}