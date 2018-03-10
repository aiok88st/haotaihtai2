<?php

namespace app\index2\controller;

use think\Controller;
use think\Exception;
use think\Request;

use app\index2\model\AdminOpen;

use app\index2\model\AdminShare;
use app\index2\model\AdminLottery;

class Test extends Controller {
    public function gift(Request $request,AdminLottery $adminLottery){
        $data=$adminLottery::all(['member_id'=>UID,'prize_id'=>['NEQ',10]]);
        var_dump($data);
        exit;
        $status=[
            11=>0,
            10=>1,
            9=>2,
            8=>3,
            7=>4,
            6=>5,
            5=>6,
            4=>7,
        ];
        $list=[];
        foreach ($data as $key=>$value){
            $list['all'][$key]['lid']=$value['id'];
            $list['all'][$key]['id']=$status[$value['prize_id']];
            $list['all'][$key]['dan']=$value['logistics']?$value['logistics']:"暂无单号";
            $list['all'][$key]['status']=$value['status'];
        }

        $on00=$adminLottery->where('prize_id',10)
            ->where('status',0)
            ->where('member_id',UID)
            ->count();
        $lid=$adminLottery->where('prize_id',10)
            ->where('status',0)
            ->where('member_id',UID)
            ->order('id asc')
            ->value('id');

        if($on00>0){
            array_push($list['all'],[
                'lid'=>$lid,
                'id'=>1,
                'dan'=>'',
                'status'=>0,
                'number'=>$on00
            ]);
        }
        return $list;
    }
    public function fd(){
        $today20=strtotime('Y-m-d 00:00:00');
        $today21=strtotime('Y-m-d 03:00:00');
        $today22=strtotime('Y-m-d 06:00:00');
        $today23=strtotime('Y-m-d 09:00:00');
        $today24=strtotime('Y-m-d 12:00:00');
        $today25=strtotime('Y-m-d 15:00:00');
        $today26=strtotime('Y-m-d 18:00:00');
        $today27=strtotime('Y-m-d 21:00:00');
        $today28=strtotime('Y-m-d 23:59:59');
        $time=time();
        $eq=0;
        switch ($time){
            case $time>=$today20:
                $eq=0;
                break;
            case $time>=$today21:
                $eq=1;
                break;
            case $time>=$today22:
                $eq=2;
                break;
            case $time>=$today23:
                $eq=3;
                break;
            case $time>=$today24:
                $eq=4;
                break;
            case $time>=$today25:
                $eq=5;
                break;
            case $time>=$today26:
                $eq=6;
                break;
            case $time>=$today27:
                $eq=7;
                break;
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
?>