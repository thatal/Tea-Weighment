<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends User
{
    use SoftDeletes;
    protected $table = "users";

    protected $attributes = [
        'role' => "vendor"
    ];
    public static $role = "vendor";
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
}
