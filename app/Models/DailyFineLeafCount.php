<?php

namespace App\Models;

use App\Services\CommonService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DailyFineLeafCount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class, "headquarter_id", "id");
    }

    public function factory()
    {
        return $this->belongsTo(Factory::class, "factory_id", "id");
    }
    /**
     * Scope a query to only include todays count
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday($query)
    {
        return $query->whereDate('date', date("Y-m-d"));
    }

    /**
     * Scope a query to only include factoryFilter
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFactoryFilter($query)
    {
        if(auth()->check()){
            if(CommonService::isFactory()){
                return $query->where('factory_id', auth()->id());
            }
        }
        return $query;
    }
}
