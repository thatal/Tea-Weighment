<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;

class Headquarter extends User
{
    protected $table = "users";

    protected $attributes = [
        'role' => "headquarter"
    ];

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
            $builder->where('role', '=', "headquarter");
        });
    }

    public static function rules()
    {
        return [
            "code"      => "required|unique:users,username|max:20",
            "email"     => "required|max:100",
            "name"      => "required|max:100",
            "address_1" => "required|max:255",
            "address_2" => "nullable|max:255",
            "pin"       => "required|digits:6",
            "password"   => "required|min:6",
        ];
    }
    public static function updateRules()
    {
        return collect(self::rules())->except(["password", "code"])->toArray();
    }

    public function factories_info()
    {
        return $this->hasMany(FactoryInformation::class, "headquarter_id", "id");
    }
}
