<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;

class Factory extends User
{
    protected $table = "users";
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
            $builder->where('role', '=', "factory");
        });
    }
}
