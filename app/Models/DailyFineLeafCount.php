<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class DailyFineLeafCount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable, SoftDeletes;

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
}
