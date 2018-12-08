<?php

namespace App\Http\Controllers\Api;

use App\Models\ThirdPartyCall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThirdPartyCallController extends Controller
{
    //
    public $thirdPartyCall;
    public function __construct(ThirdPartyCall $thirdPartyCall)
    {
        $this->thirdPartyCall=$thirdPartyCall;
    }
    public function getThirdPartyCallNum()
    {
        try{
            $data=$this->thirdPartyCall->getThirdPartyCallNum();
            return $data;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}
