<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\userDetails;
use App\Models\VendorCompanyProfile;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'fname',
         'lname',
         'email',
         'password',
         'role',
         'status',
         'free_deal',
         'last_login_at',
     ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userDetails()
    {
        return $this->belongsTo('App\Models\UserDetails', 'id', 'user_id');
    }
    public function vendorCompany()
    {
        return $this->belongsTo('App\Models\VendorCompanyProfile', 'id', 'user_id');
    }

    public function company()
    {
        return $this->hasMany('App\Models\VendorCompanyProfile');
    }

}
