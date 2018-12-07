<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function notAcceptedBacklogProportion()
    {
        try{
            $notAccepted=Order::notAccepted();
            $notAcceptedData=$this->handel($notAccepted);
            $backlog=Order::backlog();
            $backlogData=$this->handel($backlog);
            if(count($backlogData) > count($notAcceptedData)){
                $res=$this->comparison($backlogData,$notAcceptedData);
            }else{
                $res=$this->comparison($notAcceptedData,$backlogData);
            }
            return response()->json($res);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function timeGap()
    {
        try{
            $data=Order::timeGap();
            dd($data);

        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function handel($data)
    {
        try{
            $res=[];
            foreach ($data as $v){
                if(isset($v['zfbw']['gd_name'])){
                    $res[$v['zfbw']['gd_name']]=$v['num'];
                }
            }
            return $res;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function comparison($bigData,$smallData)
    {
        try{
            $res=[];
            foreach($bigData as $k=>$v){
                if(isset($smallData[$k])){
                    $res[$k]=$smallData[$k]/$v;
                }else{
                    $res[$k]=1;
                }
            }
            return $res;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}
