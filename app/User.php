<?php

namespace App;

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
        'name', 'email', 'password','username'
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
}
