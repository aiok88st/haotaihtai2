<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 通用加密
function encrypt($txt){
    $key=config('env')['APP_KEY'];
    srand((double)microtime() * 1000000);
    $encrypt_key = md5(rand(0, 32000));
    $ctr = 0;
    $tmp = '';
    for($i = 0;$i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
    }
    return base64_encode(passport_key($tmp, $key));
}
// 通用解密
function decrypt($txt){
    $key=config('env')['APP_KEY'];
    $txt = passport_key(base64_decode($txt), $key);
    $tmp = '';
    for($i = 0;$i < strlen($txt); $i++) {
        $md5 = $txt[$i];
        $tmp .= $txt[++$i] ^ $md5;
    }
    return $tmp;
}
//加密解密解析函数
function passport_key($txt, $encrypt_key) {
    $encrypt_key = md5(md5($encrypt_key));
    $ctr = 0;
    $tmp = '';
    for($i = 0; $i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
    }
    return $tmp;
}
/**用户权限列表**/
function user_action_list($uid){
    $auth=db('admin_admin')->where('id',$uid)->value('auth');
    if($auth){
        return explode(',',$auth);
    }
    return [];
}
function rejson($code,$msg){
    return json(['code'=>$code,'msg'=>$msg,'token'=>request()->token()]);
}
function tree_list($list,$parent_id){
    $tree=[];
    foreach ($list as $key=>$value){
        if($value['parent_id']==$parent_id){
            $value['child']=tree_list($list,$value['id']);
            $tree[]=$value;
        }
    }
    return $tree;
}
//去掉 地区后缀
function rempca($str){
    return str_replace(['省','市','区','县'],'',$str);
}
//curl获取请求文本内容
function get_curl_contents($url, $method ='GET', $data = array(),$headers='') {
    if ($method == 'POST') {
        //使用crul模拟
        $ch = curl_init();
        //禁用https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //允许请求以文件流的形式返回
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        if(!empty($headers)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result = curl_exec($ch); //执行发送

        curl_close($ch);
    }else {
        if (ini_get('allow_fopen_url') == '1') {
            $result = file_get_contents($url);
        }else {
            //使用crul模拟
            $ch = curl_init();
            //允许请求以文件流的形式返回
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //禁用https
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch); //执行发送
            curl_close($ch);
        }
    }
    return $result;
}

function get_rand($proArr) {
    $result = '';
    //概率数组的总概率精度

    $arr=array();
    foreach ($proArr as $key => $val) {
        $arr[$val['id']] = $val['v'];
    }
    $proSum = array_sum($arr);
    //概率数组循环
    foreach ($arr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset ($proArr);
    return $result;
}
function togbk($str){
    $str2=str_replace("\n",'',$str);
    return str_replace("\r",'',$str2);
//    return iconv('utf-8','GB2312//TRANSLIT//IGNORE', str_replace("\r\n",'',$str));
}
/*
* randChar()    生成随机字符串
* $len       生成长度
*/
function randChar($len) {
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz_";
    $max = strlen($strPol)-1;
    $strPol = str_split($strPol);
    $string = '';
    for ($i = 0; $i < $len; $i++) {
        $string .= $strPol[mt_rand(0, $max)];
    }
    return $string;
}

function GetIpLookup($ip = ''){

    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
    if(empty($res)){ return false; }
    $jsonMatches = array();
    preg_match('#\{.+?\}#', $res, $jsonMatches);
    if(!isset($jsonMatches[0])){ return false; }
    $json = json_decode($jsonMatches[0], true);
    if(isset($json['ret']) && $json['ret'] == 1){
        $json['ip'] = $ip;
        unset($json['ret']);
    }else{
        return false;
    }
    return $json;
}
function my_msg($msg,$url){
    $html = ' <script type="text/javascript">';
    $html .='alert("'.$msg.'");';
    $html .=' window.location.href="'.$url.'";';
    $html .='</script>';
    echo $html;
}
//补0
function add_zero($data){
    return 'HTT'.sprintf("%04d",$data);
}