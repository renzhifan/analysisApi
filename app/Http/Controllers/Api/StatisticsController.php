<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends OrderController
{

    public function countByArea()
    {
        try{
            return  $this->user->countByVillage();
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }

}
