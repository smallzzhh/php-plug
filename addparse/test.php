<?php
/**
 * Created by PhpStorm.
 * User: smallzz
 * Date: 2019/10/25
 * Time: 17:17
 */

namespace addparse;


class test
{
    /**
     * 调用方法
     * @return mixed
     */
    public function addressPar(){
        $param = $this->request->param();
        $arr = [];
        if(!isset($param['address']) || empty($param['address']))  return $this->ajaxError(500,[],'待解析地址不能为空');
        try{
            $resDetail = Address::smart_parse($param['address']);
            if(!empty($resDetail)){
                $arr['name'] = $resDetail['name'];
                $arr['phone'] = $resDetail['mobile'];
            }
            $resCity = AddressDetail::detail_parse($resDetail['detail']);
            if(!empty($resCity)){
                $arr['province_id'] = $resCity[1]['area_id'];
                $arr['province'] = $resCity[1]['area_name'];
                $arr['city_id'] = $resCity[2]['area_id'];
                $arr['city'] = $resCity[2]['area_name'];
                $arr['area_id'] = $resCity[3]['area_id'];
                $arr['area'] = $resCity[3]['area_name'];
                $str = $resDetail['detail'];
                $str = str_replace($arr['area'],'',$str);
                $str = str_replace($arr['city'],'',$str);
                $str = str_replace($arr['province'],'',$str);

                $arr['address'] = $str;
            }
        }catch (Exception $exception){
            return $this->ajaxError(500,['error'=>$exception->getMessage()],'解析失败');
        }
        return $this->ajaxSuccess(2002,$arr,'解析成功');
    }
}