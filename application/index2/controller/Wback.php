<?php

namespace app\index2\controller;

use think\Controller;
use think\Exception;
use app\index2\model\AdminOrder;
class Wback
{
    /**
     * 异步接收订单返回信息，订单成功付款后，处理订单状态并批量生成用户的二维码
     * @param int $id 订单编号
     */
    public function notify()
    {
//        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents("php://input");
        file_put_contents('./payLogs.txt',$postStr.PHP_EOL, FILE_APPEND);
        $xmlObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if($xmlObj->result_code == 'SUCCESS'){
            //支付成功
            try{
                $order = new AdminOrder;
                $o = $order->where('out_trade_no',$xmlObj->out_trade_no)->find();
                $data['status'] = 1;//已支付
                $data['code'] = add_zero($o['id']);
                $order->where('id',$o['id'])->update($data);
            }catch (Exception $e){

            }
        }
    }
}