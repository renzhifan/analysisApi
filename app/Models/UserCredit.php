<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    //
    protected $table = 't_user_credit';
    protected $primaryKey = 'uid';
    public $timestamps = false;
    protected $guarded = [];

    public static function userCreaditCreate($attributes)
    {
        return static::create($attributes);
    }
    public static function userCredit()
    {
        return static::query()->selectRaw('credit_name,count(1) as num')->whereNotNull('credit_name')->groupBy('credit_name')->get()->toArray();
    }
}
