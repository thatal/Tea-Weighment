<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends User
{
    use SoftDeletes, HasApiTokens;
    protected $table = "users";

    protected $attributes = [
        'role' => "vendor",
    ];
    public static $role = "vendor";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', "created_at", "deleted_at", "updated_at", "email_verified_at",
    ];
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', '=', self::$role);
        });
    }
    public function vendor_information()
    {
        return $this->hasOne(VendorInformation::class, "vendor_id", "id");
    }

    public function bank_details()
    {
        return $this->hasMany(VendorBankDetails::class, "vendor_id", "id");
    }
    public static function lognRules()
    {
        return [
            "username" => "required",
            "password" => "required",
            "role"     => "required|in:vendor,factory"
        ];
    }
}
