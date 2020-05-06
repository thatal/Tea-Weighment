<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;

class Admin extends User
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
    protected static function booted()
    {
        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', '=', "admin");
        });
    }
}
