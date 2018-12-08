<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderLoan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderLoanController extends Controller
{
    //
    public $orderLoan;
    public function __construct(OrderLoan $orderLoan)
    {
        $this->orderLoan=$orderLoan;
    }
    public function getGroupByBankName()
    {
        try{
            $data=$this->orderLoan->getGroupByBankName();
            return $data;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
    public function getGroupByState()
    {
        try{
            $data=$this->orderLoan->getGroupByState();
            $res=[];
            foreach ($data as $v){
                $v['state_name']=$this->replace($v['state']);
                if(in_array($v['state'], ['t_order_loan_state_0','t_order_loan_state_5'])){
                    $res[]=$v;
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
                case 't_order_loan_state_0':
                    $res='申请';
                    break;
                case 't_order_loan_state_5':
                    $res='审核通过';
                    break;
            }
            return $res;
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}
