<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdPartyCall extends Model
{
    //
    protected $table = 't_third_party_call';
    protected $primaryKey = 'oid';
    public $timestamps = false;
    //UPDATE t_third_party_call SET third_party_call =ROUND(RAND()*(10-1)+1)
    public static function getThirdPartyCallNum()
    {
        return static::query()->selectRaw('typename,sum(third_party_call) as num')->whereNotNull('typename')->groupBy('typename')->get()->toArray();
    }
}
