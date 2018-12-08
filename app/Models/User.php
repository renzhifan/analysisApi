<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 't_user';
    protected $primaryKey = 'uid';
    public $timestamps = false;
    public static function countByVillage()
    {
        return static::query()->selectRaw('village,count(1) as num')->whereNotNull('village')->groupBy('village')->get()->toArray();
    }
}
