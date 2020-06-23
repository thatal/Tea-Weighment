<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorOffer extends Model
{
    use SoftDeletes;
    public static $pending_status = "pending";
    public static $confirm_status = "confirmed";
    public static $status         = [
        "pending"   => "pending",
        "confirmed" => "confirmed",
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', "deleted_at", "updated_at"];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, "vendor_id", "id")->withTrashed();
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class, "factory_id", "id")->withTrashed();
    }
    /**
     * Scope a query to only include pending
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', self::$pending_status);
    }
    /**
     * Scope a query to only include pending
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', self::$confirm_status);
    }

    /**
     * Scope a query to only include latest order by id desc
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query)
    {
        return $query->orderBy("id", "DESC");
    }
}
