<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdPartyCall extends Model
{
    //
    protected $table = 't_third_party_call';
    protected $primaryKey = 'oid';
    public $timestamps = false;
    public static function getThirdPartyCallNum()
    {
        return static::query()->selectRaw('typename,sum(third_party_call) as num')->whereNotNull('typename')->groupBy('typename')->get()->toArray();
    }
}
