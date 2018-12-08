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
        return $this->hasOne('App\Models\Zfbw','gd_id','gd_id')->select('gd_id','gd_name');
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
        return static::query()->with('zfbw')->selectRaw('gd_id,updatetime,createtime')->whereNotNull('gd_id')->whereNotNull('createtime')->whereNotNull('updatetime')->get()->toArray();
    }
    public static function getGroupByGdIdNum()
    {
        return static::query()->with('zfbw')->selectRaw('gd_id,count(1) as num')->whereNotNull('gd_id')->whereNotNull('createtime')->whereNotNull('updatetime')->groupBy('gd_id')->get()->toArray();
    }
    public function countByName()
    {
        return static::query()->selectRaw('typename,count(1) as num')->whereNotNull('typename')->groupBy('typename')->get()->toArray();
    }
    public function countByNameAndState()
    {
        return static::query()->selectRaw('typename,count(1) as num')->whereNotNull('typename')->groupBy('typename')->where('state',1)->get()->toArray();
    }
    public function countByOrderStateName()
    {
        return static::query()->selectRaw('state,count(1) as num')->whereNotNull('state')->groupBy('state')->get()->toArray();
    }

}
