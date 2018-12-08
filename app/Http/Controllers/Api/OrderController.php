<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrderController extends Controller
{
    //
    public $order;
    public $user;
    public function __construct(Order $order,User $user)
    {
        $this->order=$order;
        $this->user=$user;
    }
    public function notAcceptedBacklogProportion()
    {
        try{
            $notAccepted=$this->order->notAccepted();
            $notAcceptedData=$this->handel($notAccepted);
            $backlog=$this->order->backlog();
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
            $data=$this->order->timeGap();
            $getGroupByGdIdNum=$this->order->getGroupByGdIdNum();
            $resGetGroupByGdIdNum=[];
            foreach($getGroupByGdIdNum as $value){
                if(isset($value['zfbw']['gd_name'])){
                    $resGetGroupByGdIdNum[$value['zfbw']['gd_name']]=$value['num'];
                }
            }
            $res=[];
            $resData=[];
            foreach($data as $val){
                $res['gd_name']=$val['zfbw']['gd_name'];
                $res['time_gap']=strtotime($val['updatetime'])-strtotime($val['createtime']);
                $resData[]=$res;
            }
            $collection=collect($resData)->groupBy('gd_name')->toArray();
            $result=[];
            foreach ($collection as $key=>$item){
                $result[$key]=number_format(((intval(collect($item)->sum('time_gap')/$resGetGroupByGdIdNum[$key]))/3600),2).'小时';
            }
            return $result;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function countByName()
    {
        try{
            $data=$this->order->countByName();
            $res=[];
            if($data){
                foreach ($data as $v){
                    $v['typename']=str_replace("办理", "", $v['typename']);
                    $res[]=$v;
                }
            }
            return $res ;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function countByCreateTime()
    {
        try{
            $data=DB::select("SELECT DATE_FORMAT(createtime,'%Y-%m') as createtime,COUNT(1) AS num FROM t_user 
  where createtime between date_sub(now(),interval 7 month) and now()
 GROUP BY DATE_FORMAT(createtime,'%Y-%m') ORDER BY DATE_FORMAT(createtime,'%Y-%m') DESC");
            return $data;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function countByOrderState()
    {
        try{
            $data=$this->order->countByNameAndState();
            $res=[];
            if($data){
                foreach ($data as $v){
                    $v['typename']=str_replace("办理", "", $v['typename']);
                    $res[]=$v;
                }
            }
            return $res;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function countByOrderStateName()
    {
        try{
            $data=$this->order->countByOrderStateName();
            $res=[];
            if($data){
                foreach($data as $v){
                    $v['state_name']=$this->replace($v['state']);
                    if($v['state']<4){
                        $res[]=$v;
                    }
                }
            }
            return $res;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function replace($state)
    {
        try{
            $res='';
            switch ($state)
            {
                case 0:
                        $res='待审核';
                    break;
                case 1:
                        $res='审核通过';
                    break;
                case 2:
                    $res='审核不通过';
                    break;
                default:
                   $res='已废弃';
            }
            return $res;
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
