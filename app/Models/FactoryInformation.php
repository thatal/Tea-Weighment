<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FactoryInformation extends Model
{
    use SoftDeletes;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function factory()
    {
        return $this->belongsTo(Factory::class, "user_id", "id");
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class, "headquarter_id", "id");
    }
}
