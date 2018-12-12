<?php

namespace App\Http\Controllers;

use App\Models\UserCredit;
use Illuminate\Http\Request;
use App\Models\User;
class TestController extends Controller
{
    //
    public function test()
    {
        try{
            $data=User::withCount('orders')->groupBy('uid')->limit(10000)->get();
            foreach($data as $v){
                $name='一般';
                if($v->orders_count>70 && $v->orders_count<85)
                {
                    $name='良好';
                }elseif ($v->orders_count>=85){
                    $name='优秀';
                }
                UserCredit::userCreaditCreate(['uid'=>$v->uid,'credit_name'=>$name,'credit_score'=>$v->orders_count]);
            }
            dd(111);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}
