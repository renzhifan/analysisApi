<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'api','middleware' => ['web']], function () {
    //c t_order按t_zfbw.gd_name统计未受理（state为0）和积压（state非0）的比例 Not accepted
    Route::get('/notAcceptedBacklogProportion','Api\OrderController@notAcceptedBacklogProportion');

    //t_order按t_zfbw.gd_name统计updatetime有值的updatetime与createtime时间差的平均数
    Route::get('/timeGap','Api\OrderController@timeGap');

    //1-b t_order 按typename统计数量，显示类型名称对应数量
    Route::get('/countByName','Api\OrderController@countByName');

    //1-d t_order 按createtime统计近7个月数量，显示月份和数量
    Route::get('/countByCreateTime','Api\OrderController@countByCreateTime');

    //a t_order 按typename统计受理后（state为1）的数量，显示类型名称对应数量
    Route::get('/countByOrderState','Api\OrderController@countByOrderState');

    //4-b t_order 按state统计数量，显示state名称对应数量
    Route::get('/countByOrderStateName','Api\OrderController@countByOrderStateName');

    //t_user 按village统计数量，显示村名称对应数量
    Route::get('/countByArea','Api\StatisticsController@countByArea');

    //b t_order_loan按bank_name统计数量，显示银行和数量
    Route::get('/getGroupByBankName','Api\OrderLoanController@getGroupByBankName');

    //c t_order_loan按state的“t_order_loan_state_0，t_order_loan_state_5”统计数量，显示“申请，审核通过”和数量
    Route::get('/getGroupByState','Api\OrderLoanController@getGroupByState');

    //需要造个第三方调用表（包含调用次数），将1万条t_order中state为1的数据放入，每条调用1-10次范围的随机数，按t_order的type_name统计调用总次数
    Route::get('/getThirdPartyCallNum','Api\ThirdPartyCallController@getThirdPartyCallNum');
});
