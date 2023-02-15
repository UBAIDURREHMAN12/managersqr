<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name'
    ];

    public function carddetails()
    {
        return $this->hasOne(CardDetail::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'user_id', 'id');
    }

    public function customQrCodes()
    {
        return $this->hasMany(CustomQrCode::class, 'user_id', 'id');
    }

    public function customWebsites()
    {
        return $this->hasMany(CustomWeb::class, 'user_id', 'id');
    }

    public function feedbackType()
    {
        return $this->hasMany(FeedbackType::class, 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'org_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'user_id', 'id');
    }

    public function temporaryLogos()
    {
        return $this->hasMany(TempLogo::class, 'userId', 'id');
    }

    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'user_id', 'id');
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'user_id', 'id');
    }

    public function vendorCategories()
    {
        return $this->hasMany(VendorCategory::class, 'user_id', 'id');
    }

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
    ];
}
