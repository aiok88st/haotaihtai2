var url=APP_URL+'/';
// var url="";
//加载页面的图片
var loadImg = [
	{path:url+'img/logo.png',type:'img',name:'logo'},//logo
	{path:url+'img/music.png',type:'img',name:'music'},//音乐
	{path:url+'img/loadBkg.jpg',type:'img',name:'loadBkg'},//加载背景
	{path:url+'img/jin.png',type:'img',name:'jin'},//金粉
	{path:url+'img/sun.jpg',type:'img',name:'sun'},//太阳
]
//加载的图片的资源
var gameImg = [
	{path:url+'img/address.png',type:'img',name:'address'},//地址
	{path:url+'img/go.png',type:'img',name:'go'},//去
	{path:url+'img/gong.png',type:'img',name:'gong'},//锣
	{path:url+'img/gongBottom.png',type:'img',name:'gongBottom'},//锣的底部
	{path:url+'img/gongBottom1.png',type:'img',name:'gongBottom1'},//锣的底部
	{path:url+'img/hit.png',type:'img',name:'hit'},//敲
	{path:url+'img/indexBack.jpg',type:'img',name:'indexBack'},//首页背景
	{path:url+'img/back.jpg',type:'img',name:'back'},//首页背景
	{path:url+'img/shareBack.jpg',type:'img',name:'shareBack'},//首页背景
	{path:url+'img/logo.png',type:'img',name:'logo'},//logo
	{path:url+'img/Title.jpg',type:'img',name:'Title'},//首页标题1
	{path:url+'img/Title0.jpg',type:'img',name:'Title0'},//首页标题1
	{path:url+'img/Title1.png',type:'img',name:'Title1'},//首页标题2
	{path:url+'img/Title2.png',type:'img',name:'Title2'},//首页标题3
	{path:url+'img/Title3.jpg',type:'img',name:'Title3'},//标题4
	{path:url+'img/Title33.jpg',type:'img',name:'Title33'},//标题4
	{path:url+'img/Title4.jpg',type:'img',name:'Title4'},//标题5
	{path:url+'img/Title44.jpg',type:'img',name:'Title44'},//标题5
	{path:url+'img/shareTitle01.png',type:'img',name:'shareTitle01'},//分享标题
	{path:url+'img/share.png',type:'img',name:'share'},//箭头
	{path:url+'img/shareTitle02.png',type:'img',name:'shareTitle02'},//分享标题
	{path:url+'img/jinGroup.png',type:'img',name:'jinGroup'},//金粉
	{path:url+'img/gongBack.jpg',type:'img',name:'gongBack'},//锣的背景
	{path:url+'img/gongBig.png',type:'img',name:'gongBig'},//大锣
	{path:url+'img/hitBig.png',type:'img',name:'hitBig'},//大敲
	{path:url+'img/map.png',type:'img',name:'map'},//地图
	{path:url+'img/light.png',type:'img',name:'light'},//光
	{path:url+'img/line.png',type:'img',name:'line'},//线
	{path:url+'img/awardBkg.jpg',type:'img',name:'awardBkg'},//奖品背景
	{path:url+'img/alight.png',type:'img',name:'alight'},//光
	{path:url+'img/shareRed.png',type:'img',name:'shareRed'},//分享
	{path:url+'img/getBkg.jpg',type:'img',name:'getBkg'},//摇奖背景
	{path:url+'img/giftCenter.png',type:'img',name:'giftCenter'},//礼品中心
	{path:url+'img/taiger.png',type:'img',name:'taiger'},//摇奖背景
	{path:url+'img/awardGift.png',type:'img',name:'awardGift'},//1288
	{path:url+'img/window.png',type:'img',name:'window'},//窗口
	{path:url+'img/window1.png',type:'img',name:'window1'},//窗口
	{path:url+'img/shank01.png',type:'img',name:'shank01'},//摇一摇
	{path:url+'img/shank02.png',type:'img',name:'shank02'},//摇一摇
	{path:url+'img/egg.png',type:'img',name:'egg'},//摇蛋机
	{path:url+'img/shankLeft.png',type:'img',name:'shankLeft'},//摇蛋机
	{path:url+'img/ball01.png',type:'img',name:'ball01'},//彩蛋
	{path:url+'img/ball02.png',type:'img',name:'ball02'},//彩蛋
	{path:url+'img/ball03.png',type:'img',name:'ball03'},//彩蛋
	{path:url+'img/ball04.png',type:'img',name:'ball04'},//彩蛋
	{path:url+'img/ball05.png',type:'img',name:'ball05'},//彩蛋
	{path:url+'img/ball06.png',type:'img',name:'ball06'},//彩蛋
	{path:url+'img/ball07.png',type:'img',name:'ball07'},//彩蛋
	{path:url+'img/hand.png',type:'img',name:'hand'},//手
	{path:url+'img/nBkg.png',type:'img',name:'nBkg'},//数字背景
	{path:url+'img/submit.png',type:'img',name:'submit'},//手
	{path:url+'img/confirm.png',type:'img',name:'confirm'},//确定
	{path:url+'img/popWindow.png',type:'img',name:'popWindow'},//弹窗
	{path:url+'img/center.png',type:'img',name:'center'},//中心
	{path:url+'img/centers.jpg',type:'img',name:'centers'},//中心
	{path:url+'img/activity.png',type:'img',name:'activity'},//活动
	{path:url+'img/index.jpg',type:'img',name:'index'},//主页
	{path:url+'img/indexText.png',type:'img',name:'indexText'},//主页文字
	{path:url+'img/getRed.png',type:'img',name:'getRed'},//领取红利
	{path:url+'img/getGift.png',type:'img',name:'getGift'},//领取礼物
	{path:url+'img/activityBkg.jpg',type:'img',name:'activityBkg'},//活动说明
	{path:url+'img/gBkg.jpg',type:'img',name:'gBkg'},//礼品中心
	{path:url+'img/gbk.png',type:'img',name:'gbk'},//礼物背景
	{path:url+'img/has.png',type:'img',name:'has'},//兑换
	{path:url+'img/noHas.png',type:'img',name:'noHas'},//没兑换
	{path:url+'img/gift.png',type:'img',name:'gift'},//1288
	{path:url+'img/g1.png',type:'img',name:'g1'},//100代金券
	{path:url+'img/g2.png',type:'img',name:'g2'},//人偶
	{path:url+'img/g3.png',type:'img',name:'g3'},//抱枕
	{path:url+'img/g4.png',type:'img',name:'g4'},//衣架
	{path:url+'img/g5.png',type:'img',name:'g5'},//智能垃圾桶
	{path:url+'img/g6.png',type:'img',name:'g6'},//5823
	{path:url+'img/g7.png',type:'img',name:'g7'},//1583
	{path:url+'img/hands.png',type:'img',name:'hands'},//手
	{path:url+'img/backIndex.png',type:'img',name:'backIndex'},//返回首页
	{path:url+'img/return.png',type:'img',name:'return'},//返回
	{path:url+'img/flower.png',type:'img',name:'flower'},//花
	{path:url+'img/show.png',type:'img',name:'show'},//
	{path:url+'img/jf.png',type:'img',name:'jf'},//
	{path:url+'img/lightLine.png',type:'img',name:'lightLine'},//
	{path:url+'img/use.png',type:'img',name:'use'},//
	{path:url+'img/useText.png',type:'img',name:'useText'},//
	{path:url+'img/slight.png',type:'img',name:'slight'},//
	{path:url+'img/lt.png',type:'img',name:'lt'},//
	{path:url+'img/rt.png',type:'img',name:'rt'},//
	{path:url+'img/lb.png',type:'img',name:'lb'},//
	{path:url+'img/rb.png',type:'img',name:'rb'},//
	{path:url+'img/line01.png',type:'img',name:'line01'},//
	{path:url+'img/line02.png',type:'img',name:'line02'},//
	{path:url+'img/line03.png',type:'img',name:'line03'},//
	{path:url+'img/line04.png',type:'img',name:'line04'},//
	{path:url+'img/line05.png',type:'img',name:'line05'},//
	{path:url+'img/line06.png',type:'img',name:'line06'},//
	{path:url+'img/line07.png',type:'img',name:'line07'},//
	{path:url+'img/line08.png',type:'img',name:'line08'},//	
	{path:url+'img/close.png',type:'img',name:'close'},//	
];
//全局变量
var backLayer,musicLayer,textLayer,loadLayer,imgList,home,gongLayer;
//egges
function egges(x,y,name,arr,n){
	base(this,LSprite,[]);
	var self = this;
	self.x = x;
	self.y = y;
	self.bitmap = getBitmap(name);
	self.addChild(self.bitmap);
	self.arr = arr;
	self.n = n;
}
egges.prototype.play=function(time){
	var self = this;
	var sx = self.x;
	var sy = self.y;
	if(self.n == 4)
	{
		LTweenLite.to(self,time,{x:self.arr[0],y:self.arr[1],loop:true}).to(self,time,{x:self.arr[2],y:self.arr[3]}).to(self,time,{x:self.arr[4],y:self.arr[5]}).to(self,time,{x:sx,y:sy});
	}else{
		LTweenLite.to(self,time,{x:self.arr[0],y:self.arr[1],loop:true}).to(self,time,{x:self.arr[2],y:self.arr[3]}).to(self,time,{x:sx,y:sy});
	}
	
}
//数学
function num(x,y,text){
	base(this,LSprite,[]);
	var self = this;
	self.x = x;
	self.y = y;
	self.bitmap = getBitmap(imgList['nBkg']);
	self.addChild(self.bitmap);	
	self.text = new setText(3,1,42,text,'#f9eec6',true);
	self.addChild(self.text);
}
//获取人数
function getNumber(str){
	base(this,LSprite,[]);
	var self = this;
	var mystr = str.toString().split('');
	self.addChild(new setText(0,3,36,"已有",'#f9eec6',true));
	for(var i=0;i<mystr.length;i++)
	{
		self.addChild(new num(82+36*i,0,mystr[i]));
	}
	self.addChild(new setText(82+36*i,3,36,"人敲钟",'#f9eec6',true));
}
//礼物
function giftes(id,x,y,h,tN,mText,sText,lid,hassw){
	base(this,LSprite,[]);
	var self = this;
	self.x = x;
	self.y = y;
	self.bitmap = getBitmap(imgList['gbk']);
	self.addChild(self.bitmap);
	self.has = getButton(imgList['has']);
	self.has.x = 450;
	self.has.y = 30;
	self.addChild(self.has);
	self.noHas = getBitmap(imgList['noHas']);
	self.noHas.x = 450;
	self.noHas.y = 30;
	self.addChild(self.noHas);
	self.id=id;
	self.lid=lid;
	if(h==0)
	{
		self.has.visible = true;
		self.noHas.visible = false;
	}else{
		self.has.visible = false;
		self.noHas.visible = true;
	}
	self.has.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
        ha_geft=2;
        if(hassw==false){
            //礼品中心进入页面
            var link = APP_LINK+'/award?lid='+self.lid;
            $('#shuibian').attr('src',link).show();
            $('#hotata').hide();
		}else{
            popWin("温馨提示",'已过期');
		}

// 		switch(self.id){
// 			case 0:
// 			case 1:
//
// 				Ajax(APP_LINK+'/exchange','POST',{id:self.lid},function (res) {
// 					if(res.code==1){
//                         self.has.visible = false;
//                         self.noHas.visible = true;
//                         popWin("兑换成功，感谢您的参与！");
// 					}else{
//                         popWin(res.msg);
// 					}
//
//                 });
//
//
// //				popWin("兑换成功，感谢您的参与！");
// 				//礼品中心进入页面
// 				$('iframe').show();
// 				$('#hotata').hide();
// 				break;
// 			default:
//
// 				break;
// 		}

	});
	
	//一个字段
	if(tN==1)
	{
		self.mText = new setText(25,42,30,mText,"#b53833",true);
		self.addChild(self.mText);
	}else{
		self.mText = new setText(25,29,30,mText,"#b53833",true);
		self.addChild(self.mText);
		self.sText = new setText(25,69,22,sText,"#b53833",true);
		self.addChild(self.sText);
	}
}
//星星
function star(x,y,sx,sy){
	base(this,LSprite,[]);
	var self = this;
	self.bitmap = getBitmap(imgList['slight']);
	self.addChild(self.bitmap);
	self.bitmap.scaleX = sx;
	self.bitmap.scaleY = sy;
	self.x = x;
	self.y = y;
	self.sound = new LSound();
	self.addChild(self.sound);
	self.sound.load(APP_URL+'/music/b.mp3');
}
star.prototype.blind=function(){
	var self = this;
	self.tween = bling(self,0.5,0.5,1.0,true);
}
function lines(i, time) {
	lx[i] = lLxr[0];
	ly[i] = lLyr[0];
	lx1[i];
	ly1[i];
	lz[i] = setInterval(function() {
		if(lLxr[0] < lLxr[i]) {
			lx1[i] = lx[i] + 6;
		} else {
			lx1[i] = lx[i] - 6;
		}

		ly1[i] = ry(lLxr[0], lLyr[0], lLxr[i], lLyr[i], lx[i]);
		shape[i].graphics.drawLine(3, "#ffffff", [lx[i], ly[i], lx1[i], ly1[i]]);
		if(lLxr[0] < lLxr[i]) {
			if(lLxr[i] - 6 < lx[i]) {
				clearInterval(lz[i]);
			}
		} else {
			if(lLxr[i] + 6 > lx[i]) {
				clearInterval(lz[i]);
			}
		}

		lx[i] = lx1[i];
		ly[i] = ly1[i];
	}, time);
}