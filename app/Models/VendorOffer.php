<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorOffer extends Model
{
    use SoftDeletes;
    public static $pending_status = "pending";
    public static $confirm_status = "confirmed";
    public static $cancelled_status_vendor = "cancelled_by_vendor";
    public static $rejected_by_supplier = "rejected_by_supplier";
    public static $counter_offer = "counter_offer_sent";
    public static $first_wieght_status = "received";
    public static $second_wieght_status = "completed";
    public static $status         = [
        "pending"   => "pending",
        "confirmed" => "confirmed",
    ];
    protected $appends = ['first_weight_image_url', 'second_weight_image_url'];
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
    protected $hidden = ["deleted_at", "updated_at"];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, "vendor_id", "id")->withTrashed();
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class, "factory_id", "id")->withTrashed();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,"vehicle_type_id", "id");
    }
     /**
     * Get the owning confirmed_by model.
     */
    public function confirmed_by()
    {
        return $this->morphTo();
    }
     /**
     * Get the owning confirmed_by model.
     */
    public function cancelled_by()
    {
        return $this->morphTo();
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
    public function getFirstWeightImageUrlAttribute()
    {
        if($this->second_weight_image){
            return asset("storage/".$this->second_weight_image);
        }
        return $this->second_weight_image;
    }
    public function getSecondWeightImageUrlAttribute()
    {
        if($this->second_weight_image){
            return asset("storage/".$this->second_weight_image);
        }
        return $this->second_weight_image;
    }
}
