<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class Factory extends User
{
    use SoftDeletes, HasApiTokens;

    protected $table = "users";

    protected $attributes = [
        'role' => "factory"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', "created_at", "deleted_at", "updated_at", "email_verified_at",
    ];

    public static $role = "factory";
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
    public function factory_information()
    {
        return $this->hasOne(FactoryInformation::class, 'user_id', "id");
    }

    public static function rules()
    {
        return [
            "code"      => "required|max:20|".Rule::unique('users', "username")->where(function ($query) {
                return $query->where('role', self::$role);
            }),
            "email"     => "required|max:100",
            "name"      => "required|max:100",
            "address_1" => "required|max:255",
            "address_2" => "nullable|max:255",
            "location"  => "nullable|max:255",
            "mobile"    => "required|max:20|min:10",
            "pin"       => "required|digits:6",
            "password"   => "required|min:6",
        ];
    }

    public static function updateRules()
    {
        return collect(self::rules())->except(["password", "code"])->toArray();
    }
    public function isFactoryOwner(){
        return $this->whereHas("factory_information", function($query){
            return $query->where("headquarter_id", auth()->id());
        })->exists();
    }

    /**
     * Scope a query to only include pending
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->whereHas('factory_information', function($query){
            return $query->where("is_available", 1);
        });
    }
}
