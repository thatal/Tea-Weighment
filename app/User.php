<?php

namespace App;

use App\Helpers\CommonHelper;
use App\Models\Address;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username', "fcm_token", "show_slab"
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
    ];
    public function address()
    {
        return $this->hasOne(Address::class, "user_id", "id");
    }
    public function isFactory()
    {
        return strtolower($this->role) == "factory";
    }
    public function isVendor()
    {
        return strtolower($this->role) == "vendor";
    }
    public function isAdmin()
    {
        return strtolower($this->role) == "admin";
    }
    public function isHeadquarter()
    {
        return strtolower($this->role) == "headquarter";
    }
    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
    public function newOfferCreatedForSupplier()
    {

        $notification_id = $this->fcm_token;
        $title = "Greeting Notification";
        $message = "Have good day!";
        $id = $this->id;
        $type = "basic";

        $res = CommonHelper::send_notification_FCM($notification_id, $title, $message, $id,$type);

        if($res == 1){
            // success code
        }else{
            // fail code
        }
    }
}
