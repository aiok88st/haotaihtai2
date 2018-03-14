<?php

namespace app\index2\model;

use think\Exception;
use think\Model;
use think\Log;

use think\Db;
class AdminLottery extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_lottery';

    public function lottery1(){
        Db::startTrans();
        try{
            $my=AdminOpen::get(UID);  //获取用户实例
            $today=strtotime(date('Y-m-d'));
            if($my['count']<1){
                $tc=AdminShare::where('member_id',UID)
                    ->where('add_time','>=',$today)
                    ->count();
                $msg="您今日的次数已用完";
                if($tc<=0){
                    $msg="今日次数用完，分享可得一次机会";
                }
                return rejson(0,$msg);
            }
            $prize=cache("prize1"); //获取奖品缓存
            $data=[];

            /*查询是否中奖好礼*/
//            $count=$this->where('group',1)->where('add_time >='.$today)->where('member_id',UID)->count();
//
//            if($count<1){
//
//            }
            $this->where('')->lock(true);
            $today2=date('Y-m-d');


            $today3=strtotime('2017-12-10 04:21:00');

            $ip=request()->ip();

            $has_ban=db('ban_ip')->where('ip',$ip)->count();
            $ipInfos=GetIpLookup($ip);
            $prev_t=$this->where('IP',$ip)->order('id desc')->field('add_time')->find();

            if(($ipInfos['province']=="山东" && $ipInfos['city']=="city") || time()-$prev_t['add_time']<=5){
                $data[10]=[
                    'id'=>10,
                    'v'=>100
                ];
            }else{
                if(time()>=$today3 && $has_ban<=0){
                    foreach ($prize as $key=>$value){

                        $this_count=$this->where('prize_id',$value['id'])->count();

                        $day_count=$this->where('prize_id',$value['id'])->where('add_time','>= time',$today2)->count();

                        $my_count=$this->where('prize_id',$value['id'])->where('member_id',UID)->count();

                        if($this_count>=$value['number'] || $my_count>=$value['mld'] || $day_count>=$value['dl'])continue;

//                        if(in_array($value['id'],[8,9])){
//                            //时间段
//                            $ceil=ceil($value['dl']/8);
//                            $between=$this->fd();
//                            $ceil_count=$this->where('prize_id',$value['id'])->where('add_time','between time',[$between[0],$between[1]])->count();
//                            if($ceil_count>=$ceil)continue;
//                        }
                        $data[$value['id']]=[
                            'id'=>$value['id'],
                            'v'=>$value['pro'],
                        ];
                    }
                }

                if(empty($data)){
                    $data[10]=[
                        'id'=>10,
                        'v'=>100
                    ];
                }
            }
            $l=get_rand($data); //获取中奖的奖品ID,如果为积分则增加积分
            $this->save([
                'prize_id'=>$l,
                'group'=>1,
                'add_time'=>date('Y-m-d H:i:s'),
                'member_id'=>UID,
                'IP'=>$ip
            ]);
            $status=[
                11=>"A",
                10=>"B",
                9=>"C",
                8=>"D",
                7=>"E",
                6=>"F",
                5=>"G",
                4=>"H",
            ];
            $this->save([
                'code'=>$status[$l].'1'.$this->id
            ],['id'=>$this->id]);
            $my->count=$my->count-1;
            $my->save();

            Db::commit();
            return json([
                'code'=>1,
                'lid'=>$this->id,
                'pid'=>$l,
                'token'=>request()->token(),
                'has'=>$has_ban
            ]);
        }catch (Exception $e){
            Db::rollback();
            return rejson(0,'系统错误，请稍后在试');
        }

    }
    public function lottery2(){
        try{
            $my=AdminOpen::get(UID);  //获取用户实例

//            if($my['count']<1){
//                return rejson(0,'您今日的次数已用完');
//            }
            $count=$this->where('prize_id',11)->where('member_id',UID)->count();
            if($count>=1){
                return rejson(0,'已成功领取');
            }
            $this->save([
                'prize_id'=>11,
                'group'=>2,
                'add_time'=>date('Y-m-d H:i:s'),
                'member_id'=>UID,
                'IP'=>request()->ip()
            ]);

            $this->save([
                'code'=>'A'.'2'.$this->id
            ],['id'=>$this->id]);
//            $my->count=$my->count-1;
//            $my->save();
            return rejson(1,'已成功领取');
        }catch (Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
    public function fd(){
        $today20=strtotime('00:00:00');
        $today21=strtotime('03:00:00');
        $today22=strtotime('06:00:00');
        $today23=strtotime('09:00:00');
        $today24=strtotime('12:00:00');
        $today25=strtotime('15:00:00');
        $today26=strtotime('18:00:00');
        $today27=strtotime('21:00:00');
        $today28=strtotime('23:59:59');
        $time=time();

        if($time>=$today20 && $time<$today21){
            $eq=0;
        }
        if($time>=$today21 && $time<$today22){
            $eq=1;
        }
        if($time>=$today22 && $time<$today23){
            $eq=2;
        }
        if($time>=$today23 && $time<$today24){
            $eq=3;
        }
        if($time>=$today24 && $time<$today25){
            $eq=4;
        }
        if($time>=$today25 && $time<$today26){
            $eq=5;
        }
        if($time>=$today26 && $time<$today27){
            $eq=6;
        }
        if($time>=$today27 && $time<$today28){
            $eq=7;
        }
        $between=[
            0=>[
                date('Y-m-d H:i:s',$today20),
                date('Y-m-d H:i:s',$today21),
            ],
            1=>[
                date('Y-m-d H:i:s',$today21),
                date('Y-m-d H:i:s',$today22),
            ],
            2=>[
                date('Y-m-d H:i:s',$today22),
                date('Y-m-d H:i:s',$today23),
            ],
            3=>[
                date('Y-m-d H:i:s',$today23),
                date('Y-m-d H:i:s',$today24),
            ],
            4=>[
                date('Y-m-d H:i:s',$today24),
                date('Y-m-d H:i:s',$today25),
            ],
            5=>[
                date('Y-m-d H:i:s',$today25),
                date('Y-m-d H:i:s',$today26),
            ],
            6=>[
                date('Y-m-d H:i:s',$today26),
                date('Y-m-d H:i:s',$today27),
            ],
            7=>[
                date('Y-m-d H:i:s',$today27),
                date('Y-m-d H:i:s',$today28),
            ]
        ];
        return $between[$eq];
    }
}