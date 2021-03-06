<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

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
    public static function rules()
    {
        return [
            "name"   => "required|max:100",
            "weight" => "required|numeric|min:0",
        ];
    }
    public static function rulesMessages()
    {
        return [
            "name.required" => "Vehicle Type is required.",
            "name.max"      => "Vehicle Type max 100 character allowed.",
        ];
    }
}
