<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>tongxin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
    <div id="links">
       <p><a href="{{url('/api/notAcceptedBacklogProportion')}}">c t_order按t_zfbw.gd_name统计未受理（state为0）和积压（state非0）的比例 Not accepted</a></p>
       <p><a href="{{url('/api/timeGap')}}">t_order按t_zfbw.gd_name统计updatetime有值的updatetime与createtime时间差的平均数</a></p>
       <p><a href="{{url('/api/countByName')}}">t_order 按typename统计数量，显示类型名称对应数量</a></p>
       <p><a href="{{url('/api/countByCreateTime')}}">t_order 按createtime统计近7个月数量，显示月份和数量</a></p>
       <p><a href="{{url('/api/countByOrderState')}}">t_order 按typename统计受理后（state为1）的数量，显示类型名称对应数量</a></p>
       <p><a href="{{url('/api/countByOrderStateName')}}">t_order 按state统计数量，显示state名称对应数量</a></p>
       <p><a href="{{url('/api/countByArea')}}">t_user 按village统计数量，显示村名称对应数量</a></p>
       <p><a href="{{url('/api/getGroupByBankName')}}">t_order_loan按bank_name统计数量，显示银行和数量</a></p>
       <p><a href="{{url('/api/getGroupByState')}}">t_order_loan按state的“t_order_loan_state_0，t_order_loan_state_5”统计数量，显示“申请，审核通过”和数量</a></p>
       <p><a href="{{url('/api/getThirdPartyCallNum')}}">需要造个第三方调用表（包含调用次数），将1万条t_order中state为1的数据放入，每条调用1-10次范围的随机数，按t_order的type_name统计调用总次数</a></p>
    </div>
    </body>
</html>
