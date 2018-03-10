//游戏初始化
LInit(1000/40,"hotata",750,1202,main);
//游戏入口主函数
function main(){
    LGlobal.stageScale = LStageScaleMode.EXACT_FIT;//设置全屏变量
    LGlobal.screen(LStage.FULL_SCREEN);//设置全面适应
    backLayer = new LSprite();//创建背景层
    addChild(backLayer);//添加背景层到游戏环境中
    musicLayer = new LSprite();//创建音乐层
    addChild(musicLayer);//添加音乐层到游戏环境中
    LLoadManage.load(loadImg,'',loadImging);
}
//预加载页面
function loadImging(result){
	LLoadManage.load(gameImg,loadProgress,startGame);
	musicLayer.addChild(new musicBtn(15,15,0.8,0.8,result['music'],'bg'));
	//添加背景
	var back = getBitmap(result['loadBkg']);
	backLayer.addChild(back);
	//金
	var jin = getBitmap(result['jin']);
	jin.y = -140;
	jin.x = rCenterWidth(jin);
	backLayer.addChild(jin);
	bling(jin,0.5,0.75,0.25,true);
	//太阳
	var sun = getBitmap(result['sun']);
	sun.y = rCenterHeight(sun);
	sun.x = rCenterWidth(sun);
	backLayer.addChild(sun);
	bling(sun,0.6,1,0.5,true);
	//logo
	var logo = getBitmap(result['logo']);
	logo.y = 515;
	logo.x = rCenterWidth(logo);
	backLayer.addChild(logo);
	bigAndSmall(logo,2,2,1,0.05,0,true);
	//
	var bLayer = new LSprite();
	bLayer.graphics.drawRoundRect(0, "#000000", [168, 600, 416, 20, 10], true, "#440204");
	backLayer.addChild(bLayer);
	//加载层
	loadLayer = new LSprite();
	loadLayer.graphics.drawRoundRect(0, "#000000", [168, 600, 0, 20, 10], true, "#faf2c1");
	backLayer.addChild(loadLayer);
	//数字
	textLayer = new setText(0,0,30,"0%",'#f0c496');
	textLayer.x = rCenterWidth(textLayer);
	textLayer.y = 660;
	backLayer.addChild(textLayer);
	
}
//加载函数
function loadProgress(pre){
	var num = parseInt(pre);	
	textLayer.childList["0"].text = num+"%";
	textLayer.x = rCenterWidth(textLayer);
	loadLayer.graphics.clear();
	loadLayer.graphics.drawRoundRect(0, "#000000", [168, 600, 416*pre/100, 20, 10], true, "#faf2c1");
}
//游戏开始
function startGame(result){
	imgList=result;
	setTimeout(function(){
		videoShow();
	},500);
}
//视频播放
function videoShow(){
	var browser = {
		versions: function() {
			var u = navigator.userAgent,
				app = navigator.appVersion;
			return { //移动终端浏览器版本信息
				trident: u.indexOf('Trident') > -1, //IE内核
				presto: u.indexOf('Presto') > -1, //opera内核
				webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
				gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
				mobile: !!u.match(/AppleWebKit.*Mobile/i) || !!u.match(/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/), //是否为移动终端
				ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
				android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
				iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
				iPad: u.indexOf('iPad') > -1, //是否iPad
				webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
			};
		}(),
		language: (navigator.browserLanguage || navigator.language).toLowerCase()
	}
	//如果是苹果手机
	if(browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
		$('#video').fadeIn();
		document.getElementById('bg').pause();
		$('#video')[0].play();		
		document.getElementById('video').onended=function(){
			$('#video').fadeOut();
			document.getElementById('bg').play();
			homePage();
            $('#videoShow').remove();
		};
	}
    //如果是安卓手机
    if(browser.versions.android) {
        $('#videoShow').fadeIn();
        $("#videoShow").contents().find('#videoBack').show();
        $("#videoShow").contents().find('#video').fadeIn();
        var vcount = false;
        $("#videoShow").contents().find('#videoBack img').css('opacity',0.2);
        var vb = setInterval(function(){
            if(vcount==true)
            {
                vcount = false;
                $("#videoShow").contents().find('#videoBack img').css('opacity',0.1);
            }else{
                vcount = true;
                $("#videoShow").contents().find('#videoBack img').css('opacity',0.25);
            }
        },500);
        $("#videoShow").contents().find('#videoBack img').bind('touchstart',function(){
            document.getElementById('bg').pause();

            $("#videoShow").contents().find('#videoBack').hide();

            $("#videoShow").contents().find('#video')[0].play();
            $('#hotata').hide();
            window.frames["videoshow"].document.getElementById("video").onended=function(){

                $("#videoShow").contents().find('#video').fadeOut(100);
                document.getElementById('bg').play();
                $('#hotata').css('z-index',1000);
                $('#hotata').fadeIn(100,function(){
                    homePage();
                });
                $('#videoShow').remove();
            };
        });
    }
	setTimeout(function(){
		backLayer.removeAllChild();
	},500);
}
//首页
function homePage(){
	//首页层
	home = new LSprite();
	backLayer.addChild(home);
	//添加背景
	var back = getBitmap(imgList['back']);
	home.addChild(back);
	
	var Title44= getBitmap(imgList['Title']);
	home.addChild(Title44);
	Title44.x = rCenterWidth(Title44);
	Title44.y = 0;
	Title44.alpha = 0;
	var Title4= getBitmap(imgList['Title0']);
	home.addChild(Title4);
	Title4.x = rCenterWidth(Title4);
	Title4.y = 0;
	Title4.visible = false;
	bling(Title4,0.7,0.5,1.0,true);
	//logo
	var logo = getBitmap(imgList['logo']);
	home.addChild(logo);
	logo.x=rCenterWidth(logo);
	logo.y=70;
	logo.alpha=0;
	//centers
	var centers = getBitmap(imgList['centers']);
	home.addChild(centers);
	centers.y=581;
	centers.alpha=0;
	//主题1
	var Title1 = getBitmap(imgList['Title1']);
	home.addChild(Title1);
	Title1.x=rCenterWidth(Title1);
	Title1.y=540;
	Title1.alpha=0;
//	bigAndSmall(Title1,2,2,1.4,0.02,0,true);
	//主题2
	var Title2 = getBitmap(imgList['Title2']);
	home.addChild(Title2);
	Title2.x=rCenterWidth(Title2);
	Title2.y=622;
	Title2.alpha=0;
	//锣
	var gong = getBitmap(imgList['gong']);
	home.addChild(gong);
	gong.x=rCenterWidth(gong)+1;
	gong.y=770;
	gong.alpha=0;
	//锣的背部
	var gongBottom = getBitmap(imgList['gongBottom']);
	home.addChild(gongBottom);
	gongBottom.x=rCenterWidth(gongBottom);
	gongBottom.y=755;
	gongBottom.alpha=0;
	bigAndSmall(gongBottom,2,2,2.0,0.015,0,true);
	//花
	var flower = getBitmap(imgList['flower']);
	home.addChild(flower);
	flower.x=rCenterWidth(flower);
	flower.y=720;
	flower.alpha=0;
//	LTweenLite.to(flower,6,{rotate:360,loop:true,onComplete:function(){
//		flower.rotate = 0;
//	}});
	bigAndSmall(flower,2,1.8,2.0,0.08,0,true);
	//hit
	var hit = getBitmap(imgList['hit']);
	home.addChild(hit);
	hit.x=350;
	hit.y=970;
	hit.alpha=0;
	
//	主题
//	var Title = getBitmap(imgList['Title']);
//	home.addChild(Title);
//	Title.x=rCenterWidth(Title);
//	Title.y=165;
//	Title.alpha=0;
//	bigAndSmall(Title,2,2,1.0,0.02,0,true);
	//逐层显示
	//手
	var hand = getBitmap(imgList['hand']);
	hand.x = rCenterWidth(hand);
	home.addChild(hand);
	hand.y = 1020;
	hand.alpha = 0;
	LTweenLite.to(logo,0.5,{alpha:1.0}).to(Title44,0.6,{alpha:1.0,onComplete:function(){
		Title4.visible = true;
		
	}}).to(Title1,0.6,{alpha:1.0}).to(centers,0.6,{alpha:1.0}).to(Title2,0.6,{alpha:1.0,onComplete:function(){
		LTweenLite.to(flower,0.6,{alpha:1.0});
		LTweenLite.to(gongBottom,0.6,{alpha:1.0}).to(hit,0.6,{alpha:1.0,onComplete:function(){
			LTweenLite.to(hit,1.0,{y:950,x:345,scaleX:1.1,sacleY:1.1,rotate:20,loop:true}).to(hit,1.0,{y:970,x:350,rotate:0,scaleX:1.0,sacleY:1.0});
			hand.alpha = 1;
			var hTween = LTweenLite.to(hand, 0.5, {
				y: 1000,
				alpha: 0,
				loop: true,
				onComplete: function() {
					hand.alpha = 1;
					hand.y = 1020;
				}
			});
			var hitLayer = new LSprite();
			home.addChild(hitLayer);
			hitLayer.graphics.drawRect(0,"#ed2456",[282,891,185,185],true,'rgba(0,0,0,0)');
			hitLayer.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
				hand.remove();
				hitLayer.removeEventListener(LMouseEvent.MOUSE_DOWN);
				hitGong();
			});
		}});
		LTweenLite.to(gong,0.6,{alpha:1.0});
	}});	
}
//敲锣
function hitGong(){
	
	//渐变	
	backLayer.removeAllChild();
	backLayer.die();
	gongLayer = new LSprite();
	backLayer.addChild(gongLayer);
//	LTweenLite.to(home,0.5,{alpha:0,onComplete:function(){
//		home.remove();
//		home=null;
//	}});
	var back = getBitmap(imgList['gongBack']);
	gongLayer.addChild(back);
	var Title = getBitmap(imgList['Title3']);
	gongLayer.addChild(Title);
	var Title3 = getBitmap(imgList['Title33']);
	gongLayer.addChild(Title3);
	bling(Title3,0.7,0.5,1.0,true);
	
	//锣的背部
	var gongBottom = getBitmap(imgList['gongBottom1']);
	gongLayer.addChild(gongBottom);
	gongBottom.x=rCenterWidth(gongBottom);
	gongBottom.y=300;
	bigAndSmall(gongBottom,2,2,2.0,0.02,0,true);
	//花
	var flower = getBitmap(imgList['flower']);
	gongLayer.addChild(flower);
	flower.scaleX = 1.3;
	flower.scaleY = 1.3;
	flower.x=rCenterWidth(flower)+10;
	flower.y=360;
	
//	bigAndSmall(flower,2,2,2.0,0.08,0,true);
	
	//大锣
	var gongBig = getBitmap(imgList['gongBig']);
	gongLayer.addChild(gongBig);
	gongBig.x=rCenterWidth(gongBig)+6;
	gongBig.y=510;
	//hit
	var hitBig = getBitmap(imgList['hitBig']);
	gongLayer.addChild(hitBig);
	hitBig.x=350;
	hitBig.y=680;
	
	//手
	var hand = getBitmap(imgList['hand']);
	hand.x = rCenterWidth(hand);
	hand.y = 780;
	hand.alpha = 0;
	gongLayer.addChild(hand);
	setTimeout(function(){
		var hitTween = LTweenLite.to(hitBig,1.0,{y:660,x:345,scaleX:1.1,sacleY:1.1,rotate:20,loop:true}).to(hitBig,1.0,{y:680,x:350,rotate:0,scaleX:1.0,sacleY:1.0});
		LTweenLite.to(flower,6,{rotate:360,loop:true,onComplete:function(){
			flower.rotate = 0;
		}});
		hand.alpha = 1;
		var hTween = LTweenLite.to(hand, 0.5, {
			y: 740,
			alpha: 0,
			loop: true,
			onComplete: function() {
				hand.alpha = 1;
				hand.y = 780;
			}
		});
		var hitLayer = new LSprite();
			gongLayer.addChild(hitLayer);
			hitLayer.graphics.drawRect(0,"#ed2456",[190,525,370,370],true,'rgba(0,0,0,0)');
			hitLayer.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
				hitLayer.removeEventListener(LMouseEvent.MOUSE_DOWN);
				LTweenLite.remove(hTween);
				hand.remove();
				LTweenLite.remove(hitTween);
				LTweenLite.to(hitBig,0.5,{y:640,x:345,scaleX:1.4,sacleY:1.4,rotate:30}).to(hitBig,0.25,{y:680,x:350,rotate:0,scaleX:1.0,sacleY:1.0,onComplete:function(){
					var g = 4;
					var gongx = gongBig.x;
					var gongs = LTweenLite.to(gongBig,0.1,{x:gongx-g,loop:true}).to(gongBig,0.1,{x:gongx+g,onStart:function(){
						g-=1;
						if(g==0){
							LTweenLite.remove(gongs);
							LTweenLite.to(gongBig,0.05,{x:gongx});
						}
					}});
					LTweenLite.to(lt,0.2,{x:50,y:326,alpha:0});
					LTweenLite.to(rt,0.2,{x:550,y:326,alpha:0});
					LTweenLite.to(lb,0.2,{x:50,y:771,alpha:0});
					LTweenLite.to(rb,0.2,{x:550,y:771,alpha:0});
					document.getElementById('gong').play();
					
					LTweenLite.to(lmap,1.5,{alpha:1,onComplete:function(){
						var time = 1;
						var str = setInterval(function(){
							lList[time].alpha = 1;
							lList[time].blind();
							lList[time].childList[1].play();
							if(time!=9)
							{
								lList[time+1].alpha = 1;
								lList[time+1].blind();
							}
							time+=2;
							if(time==11)
							{
								clearInterval(str);
								LTweenLite.to(gongLayer,1.5,{onComplete:function(){
									document.getElementById('hj').pause();
									setTimeout(index,2000);
									
								},onStart:function(){
									setTimeout(function(){
										document.getElementById('gong').pause();
										document.getElementById('hj').play();
										lined(0,5);
										lined(1,1);
										lined(2,10);
										lined(3,1);
										lined(4,8);
										lined(5,10);
										lined(6,10);
										lined(7,10);
									},500);
								}});
							}
						},250);
					}})
				}});
			});
	},1000);
	//地图
	var lmap = getBitmap(imgList['map']);
	gongLayer.addChild(lmap);
	lmap.x=29;
	lmap.y=900;
	lmap.alpha=0.3;
	var shape = [];
	for(var i=0;i<10;i++)
	{
		shape[i] = new LShape();
		gongLayer.addChild(shape[i]);
	}
	//光
	LGlobal.webAudio = false;
	var lList = [];
	var lLx = [525,275,118,180,380,360,395,454,625,630];
	var lLy = [980,885,970,1060,920,1025,1095,915,915,1110];
	for(var i=0;i<lLx.length;i++)
	{
		if(i==0)
		{
			lList.push(new star(lLx[i],lLy[i],3.0,3.0));
			lList[0].blind();
		}else{
			lList.push(new star(lLx[i],lLy[i],1.5,1.5));
			lList[i].alpha = 0;
		}
		gongLayer.addChild(lList[i]);
		
	}
	
	
//	var lLxr= [560,290,130,197,400,387,415,475,638,642];
//	var lLyr = [1028,908,985,1085,942,1065,1120,940,940,1135];
//	//数学计算
//	function ry(x1,y1,x2,y2,x)
//	{
//		var k = (y2-y1)/(x2-x1);
//		var b = y1-k*x1;
//		var y = k*x+b;
//		return y;
//	}
//	var lz = [];
//	var lx = [];
//	var ly = [];
//	var lx1 = [];
//	var ly1 = [];
//	function lines(i,time){
//		lx[i] = lLxr[0];
//		ly[i] = lLyr[0];
//		lx1[i];
//		ly1[i];	
//		lz[i] = setInterval(function(){
//			if(lLxr[0]<lLxr[i])
//			{
//				lx1[i]=lx[i]+6;
//			}else{
//				lx1[i]=lx[i]-6;
//			}
//			
//			ly1[i] = ry(lLxr[0],lLyr[0],lLxr[i],lLyr[i],lx[i]);
//			shape[i].graphics.drawLine(2,"rgba(232,208,156,0.75)", [lx[i], ly[i], lx1[i], ly1[i]]);
//			if(lLxr[0]<lLxr[i])
//			{
//				if(lLxr[i]-6<lx[i])
//				{
//					clearInterval(lz[i]);
//				}
//			}else{
//				if(lLxr[i]+6>lx[i])
//				{
//					clearInterval(lz[i]);
//				}	
//			}
//			
//			lx[i] = lx1[i];
//			ly[i] = ly1[i];
//		},time);
//	}
	var nlx = [281,451,123,374,215,162,99,89];
	var nly = [162,111,112,105,53,96,116,105];
	var x = [285,122,445,190,358,400,555,550];
	var y = [875,928,926,980,1015,1030,1020,932];
	
	var lineses = [];
	var vz = [];
	var vx = [];
	function lined(i,time){
		if(i<=5)
		{
			vx[i]=nlx[i];
		}else{
			vx[i]=0;
		}
		vz[i] = setInterval(function(){
			if(i<=5)
			{
				if(vx[i] != nlx[i])
				{
					lineses[i].remove();
				}
				lineses[i] = new LBitmap(new LBitmapData(imgList['line0'+(i+1)],vx[i],0,nlx[i],nly[i]));
				lineses[i].x = x[i]+nlx[i]-lineses[i].getWidth();		
				lineses[i].y = y[i]+nly[i]-lineses[i].getHeight();
				gongLayer.addChild(lineses[i]);
				vx[i]-=2;
				if(vx[i]<1){
					clearInterval(vz[i]);
				}
			}else{
				if(vx[i] != 0)
				{
					lineses[i].remove();
				}
				lineses[i] = new LBitmap(new LBitmapData(imgList['line0'+(i+1)],0,0,vx[i],nly[i]));
				lineses[i].x = x[i];		
				lineses[i].y = y[i]+nly[i]-lineses[i].getHeight();
				gongLayer.addChild(lineses[i]);
				vx[i]+=4;
				if(vx[i]>nlx[i]){
					
					clearInterval(vz[i]);
				}
			}
		},time);
	}
	//金粉
	var times = 1.5;
	var lt = getBitmap(imgList['lt']);
	lt.x = 121;
	lt.y = 447;
	gongLayer.addChild(lt);
	var rt = getBitmap(imgList['rt']);
	rt.x = 380;
	rt.y = 447;
	gongLayer.addChild(rt);
	var lb = getBitmap(imgList['lb']);
	lb.x = 121;
	lb.y = 650;
	gongLayer.addChild(lb);
	var rb = getBitmap(imgList['rb']);
	rb.x = 380;
	rb.y = 650;
	gongLayer.addChild(rb);	
//	var line = getBitmap(imgList['line']);
//	gongLayer.addChild(line);
//	line.x=112;
//	line.y=875;
//	line.alpha=0;
	
	/*
	 * data.number为已敲钟的人数
	 */
	$.get(APP_LINK+'/numbers',function(data){
		var numbers = new getNumber(data.number);
		numbers.x = LGlobal.width-numbers.getWidth()-20;
		numbers.y = 20;
		gongLayer.addChild(numbers);
	})
	
}
//分享页面
function sharing(){
	var share = new LSprite();
	backLayer.addChild(share);
	var back = getBitmap(imgList['shareBack']);
	share.addChild(back);
	//金粉
	var jin = getBitmap(imgList['jinGroup']);
	share.addChild(jin);
	jin.y = -140;
	bling(jin,0.5,1.0,0.6,true);
	//logo
	var logo = getBitmap(imgList['logo']);
	share.addChild(logo);
	logo.x=rCenterWidth(logo);
	logo.y=370;
	//分享标题01
	var shareTitle01 = getBitmap(imgList['shareTitle01']);
	share.addChild(shareTitle01);
	shareTitle01.x=rCenterWidth(shareTitle01);
	shareTitle01.y=510;
	bigAndSmall(shareTitle01,2,2,1.0,0.02,0,true);
	//分享标题02
	var shareTitle02 = getBitmap(imgList['shareTitle02']);
	share.addChild(shareTitle02);
	shareTitle02.x=rCenterWidth(shareTitle02);
	shareTitle02.y=608;
	//分享
	var shares = getBitmap(imgList['share']);
	share.addChild(shares);
	shares.x=580;//610
	shares.y=40;//24
	shares.rotate = 15;
	LTweenLite.to(shares,1.0,{x:610,y:10,rotate:0,loop:true}).to(shares,1.0,{x:570,y:40,rotate:15});
	//提示
	var textTip =new setText(0,0,24,"点击关闭分享页","#f5d8a0");
	textTip.x = rCenterWidth(textTip);
	textTip.y = 870;
	share.addChild(textTip);
	bling(textTip,1.0,0.5,0.4,true);
	//关闭分享页
	var closeBack = new LSprite();
	share.addChild(closeBack);
	closeBack.graphics.drawRect(0,"#ffffff",[0,0,LGlobal.width,LGlobal.height],false,"#ffffff");
	closeBack.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		share.remove();
	});
}
//获奖页面
function award(text,name){
	//$.get
	var awardLayer = new LSprite();
	backLayer.addChild(awardLayer);
	//
	var fanLayer = new LSprite();
	fanLayer.graphics.drawRect(0,"#ffffff",[0,0,LGlobal.width,LGlobal.height],false,"#ffffff");
	fanLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	awardLayer.addChild(fanLayer);
	//
	var back = getBitmap(imgList['awardBkg']);
	awardLayer.addChild(back);
	var txt = new setText(0,0,42,text,'#fcda91');
	txt.x = rCenterWidth(txt);
	txt.y = 188;
	awardLayer.addChild(txt);
	if(name=="gift")
	{
		var useText = getButton(imgList['useText']);
		useText.y = rCenterHeight(useText);
		useText.x = LGlobal.width-useText.getWidth();
		awardLayer.addChild(useText);
		useText.addEventListener(LMouseEvent.MOUSE_DOWN,use);
		var close = getButton(imgList['close']);
		close.x = LGlobal.width-close.getWidth()-15;
		awardLayer.addChild(close);
		close.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
			awardLayer.die();
			awardLayer.remove();
			index();
		});
	}
	if(name == 'g1')
	{
		var close = getButton(imgList['close']);
		close.x = LGlobal.width-close.getWidth()-15;
		awardLayer.addChild(close);
		close.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
			awardLayer.die();
			awardLayer.remove();
			awardGame();
		});
	}
	//分享按钮
	var shareRed = getButton(imgList['shareRed']);
	awardLayer.addChild(shareRed);
	shareRed.x=50;
	shareRed.y=950;
	bigAndSmall(shareRed,2,2,1.0,0.02,0,true);
	shareRed.addEventListener(LMouseEvent.MOUSE_DOWN,sharing);
	//中心
	var giftCenter = getButton(imgList['giftCenter']);
	awardLayer.addChild(giftCenter);
	giftCenter.x = 384;
	giftCenter.y = 950;
	bigAndSmall(giftCenter,2,2,1.0,0.02,0,true);
	giftCenter.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		awardLayer.remove();
		giftsCenter();
	});
	//光
	var alight = getBitmap(imgList['alight']);
	awardLayer.addChild(alight);
	bling(alight,0.5,1,0.6,true);
	//礼物
	var gift = getBitmap(imgList[name]);
	awardLayer.addChild(gift);
	gift.x=rCenterWidth(gift);
	gift.y=275;
}
//扭蛋
function awardGame(){
	backLayer.removeAllChild();
	backLayer.die();
	var tLayer = new LSprite();
	backLayer.addChild(tLayer);
	//
	var fanLayer = new LSprite();
	fanLayer.graphics.drawRect(0,"#ffffff",[0,0,LGlobal.width,LGlobal.height],false,"#ffffff");
	fanLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	tLayer.addChild(fanLayer);

	//1288
	var getBkg = getBitmap(imgList['getBkg']);
	tLayer.addChild(getBkg);
	//彩蛋
	var ball = [];
	var ballx = [150,200,110,350,260,375,300,450,490,530];
	var bally = [480,550,555,555,470,470,550,555,480,555];
	var balln = ['ball04','ball01','ball02','ball03','ball07','ball04','ball05','ball02','ball03','ball06'];
	var ballList = [];
	var bn = [4,4,3,4,4,4,4,4,3,3];
	var t = [0.08,0.12,0.12,0.1,0.12,0.08,0.14,0.13,0.12,0.12];
	
	ballList.push([536,400,250,285,102,380]);
	ballList.push([102,280,480,285,536,480]);
	ballList.push([536,340,110,285,102,420]);
	ballList.push([102,440,250,285,536,400]);
	ballList.push([536,400,300,200,102,380]);
	ballList.push([102,380,250,285,536,400]);
	ballList.push([102,380,250,285,536,480]);
	ballList.push([536,400,102,200,102,380]);
	ballList.push([536,285,102,450,102,380]);
	ballList.push([536,285,102,450,102,380]);
	for(var i=0;i<ballx.length;i++)
	{
		ball[i] = new egges(ballx[i],bally[i],imgList[balln[i]],ballList[i],bn[i]);
		tLayer.addChild(ball[i]);
	}
//	扭蛋机
	var back = getBitmap(imgList['egg']);
	tLayer.addChild(back);
	back.y = 169;
	back.x = rCenterWidth(back);
	//摇的左边
	var shankLeft= getBitmap(imgList['shankLeft']);
	shankLeft.x=16;
	shankLeft.y=416;
	tLayer.addChild(shankLeft);
	//返回首页
	var backIndex = getButton(imgList['backIndex']);
	tLayer.addChild(backIndex);
	backIndex.y = 1070;
	backIndex.x = 50;
	bigAndSmall(backIndex,2,2,1.0,0.02,0,true);
	backIndex.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		tLayer.remove();
		index();
	});
	var shareRed = getButton(imgList['shareRed']);
	tLayer.addChild(shareRed);
	shareRed.y = 1070;
	shareRed.x = 382;
	bigAndSmall(shareRed,2,2,1.0,0.02,0,true);	
	//窗口2
	var wd1= getBitmap(imgList['window1']);
	wd1.x=rCenterWidth(wd1)+4;
	wd1.y=291;
	tLayer.addChild(wd1);
	//摇一摇
	var shank01 = getBitmap(imgList['shank01']);
	shank01.x = 684;
	shank01.y=314;
	tLayer.addChild(shank01);
	var shank02 = getBitmap(imgList['shank02']);
	shank02.x = 684;
	shank02.y=358;
	tLayer.addChild(shank02);
	shank02.alpha = 0;
	//摇奖
	var sLayer = new LSprite();
	tLayer.addChild(sLayer);
	sLayer.graphics.drawRect(0,"#ffffff",[95,688,560,100],false,"#ffffff");

	//手
		var hand = getBitmap(imgList['hand']);
		hand.x = rCenterWidth(hand);
		hand.y= 780;
		tLayer.addChild(hand);
		var hTween = LTweenLite.to(hand,0.5,{y:740,alpha:0,loop:true,onComplete:function(){
			hand.alpha = 1;
			hand.y = 780;
		}});
		//$.get
		/*
		 * 礼物 是 g1 到  g7排序
		 * 但是现在只要 g5，尴尬
		 */

		sLayer.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
            Ajax(APP_LINK+'/lottery1','POST',{},function(res){
                if(res.code==1){

                    sLayer.removeEventListener(LMouseEvent.MOUSE_DOWN);
                    LTweenLite.remove(hTween);
                    hand.remove();
                    LTweenLite.to(shank02,0.1,{alpha:1.0});
                    LTweenLite.to(shank01,0.1,{alpha:0});
                    setTimeout(function(){
                        LTweenLite.to(shank01,0.1,{alpha:1.0});
                        LTweenLite.to(shank02,0.1,{alpha:0});
                    },200);
                    for(var i=0;i<ballx.length;i++)
                    {
                        ball[i].play(t[i]);
                    }
                    document.getElementById('a').play();
                    //$.get
					/*
					 * 礼物 是 g1 到  g7排序
					 * 但是现在只要 g5，尴尬
					 */

                    setTimeout(function(){
                        document.getElementById('a').pause();
						if(res.pid==10)
						{
							award("获得好太太100元代金券","g1");
						}else{
							var l_id=res.lid;
							var link = APP_LINK+'/award?lid='+l_id;
							setTimeout(function(){
								$('iframe').attr('src',link).show();
								$('#hotata').hide();
                                awardGame();
							},3000);
						}

                    },3000);
                }else{
                    popWin("温馨提示",res.msg);
                }

            });


		});


	
	//礼品中心
	var center = getButton(imgList['center']);
	tLayer.addChild(center);
	center.x = 628;
	center.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		sLayer.remove();
		giftsCenter();
	});
	shareRed.addEventListener(LMouseEvent.MOUSE_DOWN,sharing);
}
//老虎机
function taiger(){

	backLayer.removeAllChild();
	backLayer.die();

	var tLayer = new LSprite();
	backLayer.addChild(tLayer);
	
	tLayer.graphics.drawRect(0,"#ed2456",[0,0,750,1206],true,'#242629');
	//
	var fanLayer = new LSprite();
	fanLayer.graphics.drawRect(0,"#ffffff",[0,0,LGlobal.width,LGlobal.height],false,"#ffffff");
	fanLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	tLayer.addChild(fanLayer);
	//
	//1288
	var awardGift1 = getBitmap(imgList['awardGift']);
	tLayer.addChild(awardGift1);
	awardGift1.x = rCenterWidth(awardGift1)-3;
	awardGift1.y = 160;
	var awardGift2 = getBitmap(imgList['awardGift']);
	tLayer.addChild(awardGift2);
	awardGift2.x = rCenterWidth(awardGift2)-3;
	awardGift2.y = -500;

	//背景
	var back = getBitmap(imgList['taiger']);
	tLayer.addChild(back);
	//窗口
	var wd= getBitmap(imgList['window']);
	wd.x=rCenterWidth(wd);
	wd.y=280;
	tLayer.addChild(wd);

	//礼品中心
	var giftCenter = getButton(imgList['giftCenter']);
	tLayer.addChild(giftCenter);
	giftCenter.y = 1070;
	giftCenter.x = 50;
	bigAndSmall(giftCenter,2,2,1.0,0.02,0,true);
	var shareRed = getButton(imgList['shareRed']);
	tLayer.addChild(shareRed);
	shareRed.y = 1070;
	shareRed.x = 382;
	bigAndSmall(shareRed,2,2,1.0,0.02,0,true);	
	
	var shank01 = getBitmap(imgList['shank01']);
	shank01.x = 684;
	shank01.y=314;
	tLayer.addChild(shank01);
	
	var shank02 = getBitmap(imgList['shank02']);
	shank02.x = 684;
	shank02.y=358;
	tLayer.addChild(shank02);
	shank02.alpha = 0;
	//检测是够已经获得红利

    Ajax(APP_LINK+'/lottery2','POST',{},function(res){
        if(res.code==1)
        {
            setTimeout(function(){
                document.getElementById('t').play();
                LTweenLite.to(shank02,0.1,{alpha:1.0});
                LTweenLite.to(shank01,0.1,{alpha:0});
                LTweenLite.to(awardGift1,0.2,{loop:true,y:820,onComplete:function(){
                    awardGift1.y = 160;
                }});
                LTweenLite.to(awardGift2,0.2,{loop:true,y:160,onComplete:function(){
                    awardGift2.y = -500;
                }});
                setTimeout(function(){
                    LTweenLite.to(shank01,0.1,{alpha:1.0});
                    LTweenLite.to(shank02,0.1,{alpha:0});
                },200);
                setTimeout(function(){
                    document.getElementById('t').pause();
                	award("获得1288元购GW-1561","gift");
                    tLayer.remove();
                },2500);
            },1000);
        }else{
            popWin("您已成功领取！","分享红利给好友吧！",function(){
                award("获得1288元购GW-1561","gift");
                tLayer.remove();

			});


            giftCenter.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
                tLayer.remove();
                giftsCenter();
            });
            shareRed.addEventListener(LMouseEvent.MOUSE_DOWN,sharing);
        }
    });
}
//主页
function index(){
	
	var indexLayer = new LSprite();
	backLayer.addChild(indexLayer);
	indexLayer.alpha = 0;
	LTweenLite.to(indexLayer,0.5,{alpha:1,onComplete:function(){
		if(gongLayer)
		{
			gongLayer.remove();
		}
	}});
	//
	var fanLayer = new LSprite();
	fanLayer.graphics.drawRect(0,"#ffffff",[0,0,LGlobal.width,LGlobal.height],false,"#ffffff");
	fanLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	indexLayer.addChild(fanLayer);
	//
	var back= getBitmap(imgList['index']);
	indexLayer.addChild(back);
	//文字
	var gCode = new setText(82,20,36,"股票代码：603848",'#e8d09c');
	indexLayer.addChild(gCode);
	
	//
	var indexText = getBitmap(imgList['indexText']);
	indexLayer.addChild(indexText);
	indexText.x = rCenterWidth(indexText);
	indexText.y = 126;
	bigAndSmall(indexText,2,2,1.0,0.008,0,true);
	//
	var lightLine = getBitmap(imgList['lightLine']);
	indexLayer.addChild(lightLine);
	lightLine.x = -lightLine.getWidth();
	lightLine.y = 155;
	var llx = lightLine.x;
	LTweenLite.to(lightLine,2.0,{x:750,loop:true,onComplete:function(){
		lightLine.x = llx;
	}});
	var lightLine1 = getBitmap(imgList['lightLine']);
	indexLayer.addChild(lightLine1);
	lightLine1.rotate=180;
	lightLine1.x = 750;
	lightLine1.y = 155;	
	LTweenLite.to(lightLine1,2.0,{x:llx,loop:true,onComplete:function(){
		lightLine1.x = 750;
	}});
	//领取红利
	var getRed = getButton(imgList['getRed']);
	indexLayer.addChild(getRed);
	getRed.y = 1050;
	getRed.x = 50;
	bigAndSmall(getRed,2,2,1.0,0.02,0,true);
	getRed.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		indexLayer.die();
		indexLayer.remove();
		taiger();
	});
	//领取礼品
	var getGift = getButton(imgList['getGift']);
	indexLayer.addChild(getGift);
	getGift.y = 1050;
	getGift.x = 382;
	bigAndSmall(getGift,2,2,1.0,0.02,0,true);
	getGift.addEventListener(LMouseEvent.MOUSE_DOWN,function(){

        popWin1("抽奖已结束！","可以继续在首页领取红利","1288元优惠购GW-1561");
		// indexLayer.die();
		// indexLayer.remove();
		// awardGame();
	});
	//活动说明
	var activity = getButton(imgList['activity']);
	indexLayer.addChild(activity);
	activity.x = 510;
	activity.addEventListener(LMouseEvent.MOUSE_DOWN,activityShow);
	//礼品中心
	var center = getButton(imgList['center']);
	indexLayer.addChild(center);
	center.x = 628;
	center.addEventListener(LMouseEvent.MOUSE_DOWN,giftsCenter);
}
//活动说明
function activityShow(){
	var aLayer = new LSprite();
	backLayer.addChild(aLayer);
	aLayer.graphics.drawRect(0,"#000000",[0,0,LGlobal.width,LGlobal.height],0,"#ffffff");
	aLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	//活动背景
	var back= getBitmap(imgList['activityBkg']);
	aLayer.addChild(back);
	//测试
	var giftLayers = new LSprite();
	var nullscroll = new LBitmap(new LBitmapData(imgList['null']));//实例化空白条
	var scroll = new LScrollbar(giftLayers,625,830,{back:nullscroll,select:nullscroll,arraw:nullscroll},true,true);//滚动条
	aLayer.addChild(scroll);//添加滚动条
	scroll.x = 65;
	scroll.y = 200;	
	var show= getBitmap(imgList['show']);
	giftLayers.addChild(show);
	
	//返回首页
	var backIndex = getButton(imgList['backIndex']);
	aLayer.addChild(backIndex);
	backIndex.y = 1050;
	backIndex.x = 215;
	bigAndSmall(backIndex,2,2,1.0,0.02,0,true);
	backIndex.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		
		index();
		setTimeout(function(){
			aLayer.remove();
		},500);
	});
}
//礼品中心
function giftsCenter(){
	var gLayer = new LSprite();
	backLayer.addChild(gLayer);
	gLayer.graphics.drawRect(0,"#000000",[0,0,LGlobal.width,LGlobal.height],0,"#ffffff");
	gLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	//活动背景
	var back= getBitmap(imgList['gBkg']);
	gLayer.addChild(back);
	//测试
	var giftLayers = new LSprite();
	var nullscroll = new LBitmap(new LBitmapData(imgList['null']));//实例化空白条
	var scroll = new LScrollbar(giftLayers,641,830,{back:nullscroll,select:nullscroll,arraw:nullscroll},true,true);//滚动条
	gLayer.addChild(scroll);//添加滚动条
	scroll.x = 55;
	scroll.y = 200;
	/*

	 * 100元代金券          编号为g1
	 * 好太太安迪人偶       编号为g2
	 * 好太太抱枕               编号为g3
	 * 铝合金衣架礼盒       编号为g4
	 * 价值118元好太太智能垃圾桶  编号为g5
	 * 好太太智能晾衣架GW-5823  编号为g6
	 * 好太太智能晾衣机GW-1583  编号为g7
	 */

    var gText = ["1288元购GW-1561","100元智能代金券","安迪人偶","抱枕（价值58元）","铝合金衣架礼盒","智能垃圾桶","落地晾衣架","智能晾衣机GW-1583"];
	$.get(APP_LINK+'/gift',function(data){


		for(var i=0;i<data.all.length;i++)
		{
			switch(data.all[i].id)
			{
				case 0:
                    giftLayers.addChild(new giftes(data.all[i].id,0,141*i,data.all[i].status,2,gText[data.all[i].id],'（不含衣架和安装）',data.all[i].lid,false));
                    break;
				case 1:
					giftLayers.addChild(new giftes(data.all[i].id,0,141*i,data.all[i].status,2,gText[data.all[i].id],'数量：'+data.all[i].number,data.all[i].lid,false));
					break;
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
					giftLayers.addChild(new giftes(data.all[i].id,0,141*i,data.all[i].status,2,gText[data.all[i].id],"快递单号："+data.all[i].dan,data.all[i].lid),true);

					break;
			}
		}

	});
	//null
	var nullLayer = new LSprite();
	gLayer.addChild(nullLayer);
	nullLayer.graphics.drawRect(0,"#000000",[0,1030,LGlobal.width,176],0,"#ffffff");
	nullLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	//返回首页
	var returnIndex = new LSprite();
	gLayer.addChild(returnIndex);
	returnIndex.graphics.drawRect(0,"#000000",[42,1040,320,90],false,"#ffffff");
	returnIndex.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		index();
		setTimeout(function(){
			gLayer.remove();
		},500);
	});
	//附近门店
	var nearlLayer = new LSprite();
	gLayer.addChild(nearlLayer);
	nearlLayer.graphics.drawRect(0,"#000000",[370,1040,320,90],false,"#ffffff");
	nearlLayer.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		window.location.href="https://haotaitai.hengdikeji.com/htt/map.html";
	});
}
//通用弹窗
function popWin(text1,text2,call){
	var popLayer = new LSprite();
	backLayer.addChild(popLayer);
	popLayer.graphics.drawRect(0,"#000000",[0,0,LGlobal.width,LGlobal.height],true,"rgba(0,0,0,0.75)");
	popLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	//活动背景
	var popWindow= getBitmap(imgList['popWindow']);
	popWindow.x = rCenterWidth(popWindow);
	popWindow.y = rCenterHeight(popWindow);
	popLayer.addChild(popWindow);
	
	var txt1;
	var txt2;
	if(!text2)
	{
		//确定
		var confirm= getButton(imgList['confirm']);
		confirm.x = rCenterWidth(confirm);
		confirm.y = popWindow.y+230;
		popLayer.addChild(confirm);
		txt1 = new setText(0,0,40,text1,"#fcda91");
		txt1.x = rCenterWidth(txt1);
		txt1.y = popWindow.y+130;
		popLayer.addChild(txt1);


	}else{
		//确定
		var confirm= getButton(imgList['confirm']);
		confirm.x = rCenterWidth(confirm);
		confirm.y = popWindow.y+250;
		popLayer.addChild(confirm);
		txt1 = new setText(0,0,40,text1,"#fcda91");
		txt1.x = rCenterWidth(txt1);
		txt1.y = popWindow.y+100;
		popLayer.addChild(txt1);
		txt2 = new setText(0,0,40,text2,"#fcda91");
		txt2.x = rCenterWidth(txt2);
		txt2.y = popWindow.y+170;
		popLayer.addChild(txt2);
	}
	
	confirm.addEventListener(LMouseEvent.MOUSE_DOWN,function(){

        if(typeof(call)=='function'){
            call()
		}

        popLayer.remove();
	});
}
//通用弹窗
function popWin(text1,text2,call){
	var popLayer = new LSprite();
	backLayer.addChild(popLayer);
	popLayer.graphics.drawRect(0,"#000000",[0,0,LGlobal.width,LGlobal.height],true,"rgba(0,0,0,0.75)");
	popLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	//活动背景
	var popWindow= getBitmap(imgList['popWindow']);
	popWindow.x = rCenterWidth(popWindow);
	popWindow.y = rCenterHeight(popWindow);
	popLayer.addChild(popWindow);
	
	var txt1;
	var txt2;
	if(!text2)
	{
		//确定
		var confirm= getButton(imgList['confirm']);
		confirm.x = rCenterWidth(confirm);
		confirm.y = popWindow.y+230;
		popLayer.addChild(confirm);
		txt1 = new setText(0,0,40,text1,"#fcda91");
		txt1.x = rCenterWidth(txt1);
		txt1.y = popWindow.y+130;
		popLayer.addChild(txt1);


	}else{
		//确定
		var confirm= getButton(imgList['confirm']);
		confirm.x = rCenterWidth(confirm);
		confirm.y = popWindow.y+250;
		popLayer.addChild(confirm);
		txt1 = new setText(0,0,40,text1,"#fcda91");
		txt1.x = rCenterWidth(txt1);
		txt1.y = popWindow.y+100;
		popLayer.addChild(txt1);
		txt2 = new setText(0,0,40,text2,"#fcda91");
		txt2.x = rCenterWidth(txt2);
		txt2.y = popWindow.y+170;
		popLayer.addChild(txt2);
	}
	
	confirm.addEventListener(LMouseEvent.MOUSE_DOWN,function(){

        if(typeof(call)=='function'){
            call()
		}

        popLayer.remove();
	});
}
//通用弹窗
function popWin1(text1,text2,text3,call){
	var popLayer = new LSprite();
	backLayer.addChild(popLayer);
	popLayer.graphics.drawRect(0,"#000000",[0,0,LGlobal.width,LGlobal.height],true,"rgba(0,0,0,0.75)");
	popLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	//活动背景
	var popWindow= getBitmap(imgList['popWindow']);
	popWindow.x = rCenterWidth(popWindow);
	popWindow.y = rCenterHeight(popWindow);
	popLayer.addChild(popWindow);
	
	var txt1;
	var txt2;
	var txt3;
	if(!text2)
	{
		//确定
		var confirm= getButton(imgList['confirm']);
		confirm.x = rCenterWidth(confirm);
		confirm.y = popWindow.y+230;
		popLayer.addChild(confirm);
		txt1 = new setText(0,0,40,text1,"#fcda91");
		txt1.x = rCenterWidth(txt1);
		txt1.y = popWindow.y+130;
		popLayer.addChild(txt1);


	}else{
		//确定
		var confirm= getButton(imgList['confirm']);
		confirm.x = rCenterWidth(confirm);
		confirm.y = popWindow.y+300;
		popLayer.addChild(confirm);
		txt1 = new setText(0,0,40,text1,"#fcda91");
		txt1.x = rCenterWidth(txt1);
		txt1.y = popWindow.y+50;
		popLayer.addChild(txt1);
		txt2 = new setText(0,0,40,text2,"#fcda91");
		txt2.x = rCenterWidth(txt2);
		txt2.y = popWindow.y+135;
		popLayer.addChild(txt2);
		txt3 = new setText(0,0,40,text3,"#fcda91");
		txt3.x = rCenterWidth(txt3);
		txt3.y = popWindow.y+210;
		popLayer.addChild(txt3);
	}
	
	confirm.addEventListener(LMouseEvent.MOUSE_DOWN,function(){

        if(typeof(call)=='function'){
            call()
		}

        popLayer.remove();
	});
}
//使用说明
function use(){
	var uLayer = new LSprite();
	backLayer.addChild(uLayer);
	uLayer.graphics.drawRect(0,"#000000",[0,0,LGlobal.width,LGlobal.height],true,"rgba(0,0,0,0.75)");
	uLayer.addEventListener(LMouseEvent.MOUSE_DOWN,setNull);
	var use= getBitmap(imgList['use']);
	use.x = rCenterWidth(use);
	use.y = rCenterHeight(use);
	uLayer.addChild(use);
	var confirm= new LSprite();
	uLayer.addChild(confirm);
	confirm.graphics.drawRect(0,"#000000",[240,775,270,75],false,"rgba(0,0,0,0)");
	confirm.addEventListener(LMouseEvent.MOUSE_DOWN,function(){
		uLayer.remove();
	});
}
