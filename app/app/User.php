<?php

namespace App;

use App\Models\Deposit;
use App\Models\Payout;
use App\Models\Referral;
use App\Models\UserWallet;
use App\Models\Withdrawal;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Request;

/**
 * App\User
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $phone
 * @property string|null $btc
 * @property string|null $eth
 * @property string|null $dge
 * @property string|null $ltc
 * @property string|null $bch
 * @property bool $is_admin
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $name
 * @property-read string $photo_url
 * @property-read string $ref_url
 * @property-read string $wallet
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserWallet $userWallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'country',
        'state',
        'city',
        'phone',
        'email',
        'is_admin',
        'password',
        'btc',
        'eth',
        'dge',
        'ltc',
        'bch',
        'login_ip',
        'last_login',
        'is_kyc_verify',
        'image_path',
        'image',
        'status',
        'referral_id',
        'sponsor_id',
        'ref_code'
    ];

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

    /**
     * Get the Deposits for the user.
     */
    public function referral(){

        return $this->hasOne(Referral::class, 'user_id', 'id');
    }

    public function UserAgent(){
        return $this->belongsTo(Agent::class, 'ref_code', 'ref_code');
    }


    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    /**
     * Get the Withdrawals for the user.
     */
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * Get the Payouts for the user.
     */
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    /**
     * Get the User for the order.
     */
    public function userWallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    /**
     * Get the Testimony for the user.
     */
    public function testimonies()
    {
        return $this->hasMany(Testimony::class);
    }

    public function ReferralRegBonus($data){
        $ref = $this->GenerateRefCode();
        return Referral::create([
                    'ref' => $ref,
                    'user_id' => $data['user_id'],
                    'referrer_id' => $data['referer_id'],
                    'interest' => 10,
                    'status' => 'success'
        ]);
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getWalletAttribute()
    {
        $user = request()->user();
        if ($user && $user->id === $this->id || in_array('admin', Request::route()->gatherMiddleware())) {
            $wallet = $this->userWallet;
            if ($wallet) {
                return $wallet;
            }
        }

        return new UserWallet([
            'amount' => 0,
            'referrals' => 0,
            'bonus' => 0,
            'user_id' => $this->id
        ]);
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */

     public function GenerateRefCode(){
        $refcode = strtolower(substr(str_replace(['/', '=', '%'], '', base64_encode(random_bytes(13))),0,10));
        return $refcode;
    }

    public function getRefUrlAttribute()
    {
        if($this->ref_code == '' || $this->ref_code == null){
         auth_user()->update(['ref_code' => $this-> GenerateRefCode() ]);
        }
        return $this->ref_code;
    }

    /**
     * Check if the order is a gift.
     *
     * @param string $value
     * @return bool
     */
    public function getNameAttribute($value)
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->image_path) {
           return route('user.photo', ['id' => $this, 'file_name' => basename($this->image_path)]);
        }
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '.jpg?s=200&d=mm';
    }

    /**
     * Get the location attribute.
     *
     * @return string
     */
    public function getLocationAttribute()
    {
        if ($this->city) {
            return $this->city . ', ' . $this->state . ' ' . $this->country . '.';
        }
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
