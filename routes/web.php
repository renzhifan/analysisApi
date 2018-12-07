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
    Route::get('/notAcceptedBacklogProportion','Api\IndexController@notAcceptedBacklogProportion');
    //t_order按t_zfbw.gd_name统计updatetime有值的updatetime与createtime时间差的平均数
    Route::get('/timeGap','Api\IndexController@timeGap');
});
