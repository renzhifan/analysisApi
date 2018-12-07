<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 't_order';
    protected $primaryKey = 'oid';
    public $timestamps = false;

    public function zfbw()
    {
        return $this->hasOne('App\Models\Zfbw','gd_id','gd_id');
    }
    public static function notAccepted()
    {
        return static::query()->with('zfbw')->selectRaw('gd_id,count(1) as num')->whereNotNull('gd_id')->where('state',0)->groupBy('gd_id')->get()->toArray();
    }
    public static function backlog()
    {
        return static::query()->with('zfbw')->selectRaw('gd_id,count(1) as num')->whereNotNull('gd_id')->where('state','<>',0)->groupBy('gd_id')->get()->toArray();
    }
    public static function timeGap()
    {
        return static::query()->with('zfbw')->selectRaw('gd_id,updatetime,createtime')->whereNotNull('gd_id')->whereNotNull('createtime')->whereNotNull('updatetime')->groupBy('gd_id')->get()->toArray();
    }

}
