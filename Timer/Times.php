<?php
namespace Timer;
/**
 * Created by PhpStorm.
 * User: smallzz
 * Date: 2019/3/28
 * Time: 16:45
 */
class Times{
    //今日
    public static function today(){
        $start_date = date("Y-m-d 00:00:00");
        $end_date = date('Y-m-d 23:59:59');
        return ['s'=>$start_date,'e'=>$end_date];
    }
    //昨日
    public static function yesterday(){
        $time = date("Y-m-d",strtotime("-1 day"));
        $start_date = $time.' 00:00:00';
        $end_date = $time.' 23:59:59';
        return ['s'=>$start_date,'e'=>$end_date];
    }
    //明日
    public static function tomorrow(){
        $time = date("Y-m-d",strtotime("+1 day"));
        $start_date = $time.' 00:00:00';
        $end_date = $time.' 23:59:59';
        return ['s'=>$start_date,'e'=>$end_date];
    }
    //本周
    public static function thisWeek(){
        $start_date = date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)).' 00:00:00';
        $end_date =  date('Y-m-d', (time() + (7 - (date('w') == 0 ? 7 : date('w'))) * 24 * 3600)).' 23:59:59';
        return ['s'=>$start_date,'e'=>$end_date];
    }

    //上周
    public static function lastWeek(){
        $start_date = date('Y-m-d', strtotime('-1 monday',strtotime('-1 sunday')));
        $end_date = date('Y-m-d', strtotime('-1 sunday'));
        return ['s'=>$start_date,'e'=>$end_date];
    }

    //本月
    public static function tmonth(){
        $start_date = date('Y-m-1').' 00:00:00';
        $next = date("Y-m",strtotime("+1 month"));
        $end_date = date("Y-m-d",strtotime("$next -1 day")) . ' 23:59:59';
        return ['s'=>$start_date,'e'=>$end_date];
    }
    //上月
    public static function lastMonth(){
        //上月一日
        $start_date = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m', time()) . '-01 00:00:00')));
        $end_date = date('Y-m-d', strtotime(date('Y-m', time()) . '-01 00:00:00') - 86400);
        return ['s'=>$start_date,'e'=>$end_date];
    }

}