<?php

namespace app\admin2\controller;

use think\Controller;
use think\Request;
use app\common\controller\Table;
use app\common\controller\From;
use app\admin2\model\AdminPrize;
class Prize extends Fater
{
    public function index(Table $table,AdminPrize $adminPrize){
        $this->userauth('activity');
        $table->init($adminPrize);

        $table->deleteAction();
        $table->column('id','ID');
        $table->column('name','奖品名称');
        $table->column('group','奖品类型',[
            '积分'=>'layui-btn-warm',
            '实物礼品'=>'layui-btn-normal',
            '代金券'=>'layui-btn',
            '红包'=>'layui-btn-danger',
        ]);
        $table->column('pro','中奖概率');
        $table->column('number','奖品数量');
        $table->column('dl','每日上限');
        $table->column('mld','单人数量');
        $table->column('tl','值上限');
        $table->column('ml','值下限');
        return $table->start();
    }
    public function create(Request $request,From $from,AdminPrize $adminPrize){
        $id=$request->param('id',null);
        $option=[
            ['value'=>1,'name'=>'实物礼品'],
            ['value'=>2,'name'=>'积分'],
            ['value'=>3,'name'=>'代金券'],
            ['value'=>4,'name'=>'红包'],
        ];
        $from->init($adminPrize);
        $from->id($id);
        $from->field('text')->render('name','奖品名称')->ruls('require|max:255');
        $from->field('number')->render('pro','中奖概率')->ruls('require|number');
        $from->field('radio')->option($option)->defaults(1)->render('group','奖品类型')->ruls('require|in:1,2,3,4');
        $from->field('number')->render('number','奖品数量')->ruls('require|number');
        $from->field('number')->render('dl','每日上限')->ruls('require|number');
        $from->field('number')->defaults(1)->render('mld','单人数量')->ruls('require|number');
        $from->field('number')->render('tl','值上限')->ruls('require|number');
        $from->field('number')->render('ml','值下限')->ruls('require|number');
        return $from->start();
    }
    public function save(Request $request,From $from,AdminPrize $adminPrize){
        $param=$request->param();
        return $from->save($param,$adminPrize);
    }
    public function dele(Request $request,From $from,AdminPrize $adminPrize){
        $param=$request->param()['ids'];

        return $from->dele($param,$adminPrize);
    }


}