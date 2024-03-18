<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Constants\Status;

class User extends Authenticatable
{
    use Notifiable , Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','ver_code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'kyc_data'          => 'object',
        'ver_code_send_at' => 'datetime'
    ];

    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id','desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status','!=',0);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status','!=',0);
    }
    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }
    public function referrer()
    {
        return $this->belongsTo(User::class, 'ref_by');
    }
    public function referrals()
    {
        return $this->hasMany(User::class, 'ref_by');
    }
    public function allReferrals()
    {
        return $this->referrals()->with('referrer');
    }
    // SCOPES

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeBanned()
    {
        return $this->where('status', 0);
    }

    public function scopeEmailUnverified()
    {
        return $this->where('ev', 0);
    }

    public function scopeSmsUnverified()
    {
        return $this->where('sv', 0);
    }
    public function scopeEmailVerified()
    {
        return $this->where('ev', 1);
    }
    public function scopeMobileUnverified($query)
    {
        return $query->where('sv', Status::NO);
    }

    public function scopeKycUnverified($query)
    {
        return $query->where('kv', Status::KYC_UNVERIFIED);
    }

    public function scopeKycPending($query)
    {
        return $query->where('kv', Status::KYC_PENDING);
    }

    public function scopeSmsVerified()
    {
        return $this->where('sv', 1);
    }

}
