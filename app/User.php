<?php

namespace App;

use App\Notifications\verifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JwtSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'town', 'county', 'village', 'role','location_name'
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
        'phone_verified_at' => 'datetime',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function product(){
        return $this->hasMany(Product::class, 'user_id');
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function shop(){
        return $this->hasOne(WholesalerRetailer::class, 'user_id');
    }
    public function log(){
        return $this->hasMany(log::class, 'user_id');
    }
    public function ride(){
        return $this->hasOne(Rider::class, 'user_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new verifyEmail());
    }

    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function wallet(){
        return $this->hasOne(Wallet::class, 'rider_id');
    }

    public function WalletTransactions()
    {
        return $this->hasMany(WalletTransaction::class, 'rider_id')->latest();
    }

    public function latestRiderLocation()
    {
        return $this->hasMany(LocationTracking::class, 'user_id')->latest()->first();
    }
}
