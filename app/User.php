<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','username','email','password','user_type','mobile_number','gender','country','profile_image','bio','active','wallet_amount','profile_state','online_status','facebook_id','device_token','notification_active'];
   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'remember_token','deleted_at','created_at','updated_at'
    ];
     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function getProfileImageAttribute($value)
    {
        if($value==null || $value=='')
        {
            return 'profile_no_image.jpg';
        }
        else{
            return $value;
        }

    }

    public function listUser()
    {
        return $this->belongsTo('questions','user_id');
    }
   
}
