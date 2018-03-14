<?php

namespace app\index2\controller;

use think\Controller;
use think\Exception;
use think\Request;
use wxpay\database\WxPayUnifiedOrder;
use wxpay\JsApiPay;
use wxpay\NativePay;
use wxpay\PayNotifyCallBack;
use wxpay\WxPayApi;
use wxpay\WxPayConfig;
use app\index2\model\AdminOrder;
use app\index2\model\AdminProduct;
class Pay extends Fater
{

    public function _initialize()
    {
        parent::_initialize();
    }


    //购买换购券
    public function buy_ticket(Request $request,AdminOrder $order){
        try{
            $param=$request->param();
            $rc = session('rc');
            if($param['cr'] != $rc)return json(['code'=>0,'msg'=>'网络错误，请关闭页面重新打开']);
            //规则
            $result = $this->validate(
                $param,
                [
                    'pid|换购券' => 'require',
                    'name|姓名' => 'require|max:255',
                    'phone|手机号码' => ['require', "regex:/^1[34578]{1}[0-9]{9}$/"],
                    'old_brand|旧款品牌'=>'require|max:255',
                    'old_img|旧款照片'=>'require',
                ]);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['code' => 0, 'msg' => $result]);
            }
            //是否已购买
            $act = $order->where(['pid'=>$param['pid']])->where('open_id',UID)->find();
            if($act && $act['status'] > 0)return json(['code'=>0,'msg'=>'同一换购券只能购买一次']);
            $outTradeNo = rand(1,9999).date("YmdHis").UID.$param['pid'];//订单号
            $order->save([
                'pid'=>$param['pid'],
                'name' =>$param['name'],
                'phone' =>$param['phone'],
                'old_brand' =>$param['old_brand'],
                'old_img' =>serialize($param['old_img']),
                'open_id' =>UID,
                'out_trade_no' => $outTradeNo,
                'add_time'=>date('Y-m-d H:i:s')
            ]);
            return json(['code' => 1, 'info' => $outTradeNo]);

        }catch (Exception $e){
            return json(['code'=>0,'msg'=>$e->getMessage()]);
        }
    }

    /**
     * 微信支付使用 JSAPI
     * @return mixed
     */
    public function wxpayJSAPI(Request $request)
    {
        $param=$request->param();
        //获取用户openid
        $tools = new JsApiPay();
        $openId = session('user')['open_id'];
        //换购券信息
        $p = (new AdminProduct)->where('id',$param['pid'])->find();

        //统一下单
        $input = new WxPayUnifiedOrder();
        $input->setBody($p['name']);
        $input->setAttach($p['name']);
        $input->setOutTradeNo($param['outTradeNo']);
        $input->setTotalFee($p['price'] * 100);//金额
        $input->setTimeStart(date("YmdHis"));
        $input->setTimeExpire(date("YmdHis", time() + 600));
        $input->setGoodsTag("Reward");
        $input->setNotifyUrl('https://haotaitai.hengdikeji.com/listing.php/index2/Wback/notify');//回调地址
        $input->setTradeType("JSAPI");
        $input->setOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->getJsApiParameters($order);
        $this->assign('order', $order);
        $this->assign('jsApiParameters', $jsApiParameters);

        return $this->fetch('index/jsapi');
    }


}