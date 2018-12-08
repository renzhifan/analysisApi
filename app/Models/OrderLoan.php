<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLoan extends Model
{
    //
    protected $table = 't_order_loan';
    protected $primaryKey = 'orderid';
    public $timestamps = false;
    public static function getGroupByBankName()
    {
        return static::query()->selectRaw('bank_name,count(1) as num')->whereNotNull('bank_name')->groupBy('bank_name')->get()->toArray();
    }
    public static function getGroupByState()
    {
        return static::query()->selectRaw('state,count(1) as num')->whereNotNull('state')->groupBy('state')->get()->toArray();
    }
}
