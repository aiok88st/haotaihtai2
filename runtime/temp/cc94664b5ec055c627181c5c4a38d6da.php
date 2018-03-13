<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"F:\wamp\www\htt\application\index2/../../public/temp/index2\index\index.html";i:1520852690;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>好太太集团</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<meta content="yes" name="apple-mobile-web-app-capable"/>
		<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
		<meta content="telephone=no" name="format-detection"/>
		<link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
		<link rel="stylesheet" href="__STYLE__/css/reset.css" />
		<link rel="stylesheet" href="__STYLE__/css/index.css" />
		<script type="text/javascript" src="__STYLE__/js/rem.js" ></script>
		<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
			var APP_URL="__STYLE__";
            var my_code="<?php echo url('Index/my_ticket_status'); ?>";
            var buy_tickets="<?php echo url('Pay/buy_ticket'); ?>";
            var wxpay="<?php echo url('Pay/wxpayJSAPI'); ?>";
            var my_order="<?php echo url('Index/my_order'); ?>";
            var use_tickets="<?php echo url('Index/use_ticket'); ?>";
            var pj="<?php echo url('Index/pj_ticket'); ?>";

		</script>
	</head>
	<body>
		<!--删除不良信息-->
		<div class="delete1" hidden="hidden"></div>
        <input type="hidden" id="cr" value="<?php echo $cr; ?>">
		<!--音乐-->
		<audio id="bg" autoplay="autoplay"  loop="loop" preload  src="__STYLE__/music/bg.mp3" hidden="hidden"></audio >
		<!--音乐按钮-->
		<img src="__STYLE__/img/music.png" id="music"/>
		<!--首页-->
		<div id="homepage"  style="display: none;">
			<div class="home1 home">
				<img src="__STYLE__/img/home1.png" />
			</div>
			<div class="home2 home">
				<img src="__STYLE__/img/home2.png" />
			</div>
			<div class="home3 home">
				<img src="__STYLE__/img/home3.png" />
			</div>
			<div class="home4 home">
				<img src="__STYLE__/img/home4.png" />
			</div>
			<div class="home5 home">
				<img src="__STYLE__/img/home5.png" />
			</div>
			<div class="homep home">
				<nobr><p>活动时间：2018/3/15-2018/5/6</p></nobr>
			</div>
			<input type="image" src="__STYLE__/img/homeBtn1.png" class="oldNew home" />
			<input type="image" src="__STYLE__/img/homeBtn2.png" class="look home" />
		</div>
		<!--我的活动码-->
		<div id="myCode" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="mc mc01">
				<img src="__STYLE__/img/mc01.png" />
			</div>
			<div class="mc mc02">
				<img src="__STYLE__/img/mc02.png" />
				<button class="fiveYuan"><p>购买</p></button>
				<button class="threeYuan"><p>查看</p></button>
			</div>
			<div class="mc mc03">
				<img src="__STYLE__/img/mc03.png" />
			</div>
			<div class="mc shareBtn">
				<input type="image" src="__STYLE__/img/share.png"/>
			</div>
		</div>
		<!--购买第一步-->
		<div id="buyStep01" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="buystep01">
				<div class="bsTitle">
					<img src="__STYLE__/img/bf01.png" />
				</div>
				<div class="inputBox">
					<p>姓名</p>
					<input type="text" placeholder="请输入您的姓名" class="name"/>
				</div>
				<div class="inputBox">
					<p>联系方式</p>
					<input type="text" placeholder="请输入您的手机号码" class="phone"/>
				</div>
				<div class="inputBox">
					<p>旧款品牌</p>
					<input type="text" placeholder="请输入使用的旧款品牌"  class="old"/>
				</div>
				<div class="inputBox">
					<p>旧款照片</p>
					<div class="imageBox">
						<div class="ibIn">
							
						</div>
						<div class="floatl bsup">
							<img src="__STYLE__/img/bf02.png" />
							<input type="file" id="file" accept="image/*" capture="camera">
						</div>
						<div class="clearl"></div>
					</div>
					
				</div>
				<div class="nextBtn">
					<input type="image" src="__STYLE__/img/bf04.png" />
				</div>
			</div>
		</div>	
		<!--购买第二步-->
		<div id="buyStep02" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="bt01">
				<img src="__STYLE__/img/bt01.png" />
			</div>
			<div class="bt02">
				<img src="__STYLE__/img/bt02.png" ck="" />
				<input type="checkbox" id="checkbox"/>
			</div>
			<div class="bt03">
				<input type="image" src="__STYLE__/img/bt04.png" class="floatl btPrev"/>
				<input type="image" src="__STYLE__/img/bf04.png" class="floatr btNext"/>
				<div class="clearBoth"></div>
			</div>
		</div>
		<!--查看详情-->
		<div id="lookCode" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="lc01">
				<img src="__STYLE__/img/lc01.png" />
			</div>
			<div class="lc02">
				<p class="floatl" id="n-p">产品满意度：5分</p>
				<p class="floatr" id="n-c">服务满意度：4分</p>
				<div class="clearBoth"></div>
			</div>
			<div class="lc03">
				<div class="inputBox">
					<p>活动码编号：</p>
					<input type="text" disabled="disabled" id="n-code" placeholder="" value="92374873"/>
				</div>
				<div class="inputBox">
					<p>城市代码：</p>
					<input type="text" disabled="disabled" id="n-city" placeholder="" value="92374873"/>
				</div>
				<div class="inputBox">
					<p>产品型号：</p>
					<input type="text" disabled="disabled" id="n-brand" placeholder="" value="92374873"/>
				</div>
				<div class="inputBox">
					<p>安装效果照片：</p>
					<div class="imageBox" id="n-img">
						<div class="floatl">
							<img src="__STYLE__/img/bf02.png" />
							<!--放在第二个img数据-->
							<img src="__STYLE__/img/back.jpg" />
						</div>
						<div class="floatl">
							<img src="__STYLE__/img/bf02.png" />
							<img src="__STYLE__/img/back.jpg" />
						</div>
						<div class="floatl">
							<img src="__STYLE__/img/bf02.png" />
							<img src="__STYLE__/img/back.jpg" />
						</div>
						<div class="floatl">
							<img src="__STYLE__/img/bf02.png" />
							<img src="__STYLE__/img/back.jpg" />
						</div>
						<div class="floatl">
							<img src="__STYLE__/img/bf02.png" />
							<img src="__STYLE__/img/back.jpg" />
						</div>
						<div class="floatl">
							<img src="__STYLE__/img/bf02.png" />
							<img src="__STYLE__/img/back.jpg" />
						</div>
						<div class="clearl"></div>
					</div>
					
				</div>
				<div class="inputBox">
					<p>意见反馈：</p>
					<div class="diss">
						<p id="n-content">希望好太太越好越好希望好太太越好越好希望好太太越好越好希望好太太越好越好</p>
					</div>
				</div>
			</div>
		</div>
		<!--评价-->
		<div id="suggestion" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="sg01">
				<img src="__STYLE__/img/sg01.png" />
			</div>
			<div class="sg02">
				<div class="inputBox">
					<p>产品满意度：</p>
					<div class="starBox sbPro">
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<div class="clearl"></div>
					</div>
				</div>
				<div class="inputBox">
					<p>服务满意度：</p>
					<div class="starBox svSer">
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<img src="__STYLE__/img/sg02.png"  class="floatl"/>
						<div class="clearl"></div>
					</div>
				</div>
				<div class="inputBox" style="padding: 0.2rem 0;">
					<p>安装效果照片：</p>
					<div class="imageBox">
						<div class="setImg">
							
						</div>
						
						<div class="floatl sgup">
							<img src="__STYLE__/img/bf02.png" />
							<input type="file" id="file1" accept="image/*" capture="camera">
						</div>
						<div class="clearl"></div>
					</div>
					
				</div>
				<div class="inputBox">
					<p>意见反馈：</p>
					<div class="sgtext">
						<textarea id="content" placeholder="您还可以输入200个字符"></textarea>
					</div>
				</div>
				<div class="nextBtn">
					<input type="image" src="__STYLE__/img/sg04.png" />
				</div>
			</div>
		</div>
		<!--评价成功-->
		<div id="suggestSuccess" style="display: none;">
			<div class="ssBox">
				<img src="__STYLE__/img/sg06.png" />
				<div class="star">
					<img src="__STYLE__/img/sg07.png" />
				</div>
				<button></button>
			</div>
		</div>
		<!--使用第1步-->
		<div id="use1" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="use101">
				<img src="__STYLE__/img/use01.png" />
			</div>
			<div class="use102">
				<div class="inputBox">
					<p>姓名</p>
					<input type="text" disabled="disabled" id="name1" placeholder="" value="92374873"/>
				</div>
				<div class="inputBox">
					<p>联系电话</p>
					<input type="text" disabled="disabled" id="phone1" placeholder="" value="92374873"/>
				</div>
				<div class="inputBox">
					<p>旧款品牌</p>
					<input type="text" disabled="disabled" id="old1" placeholder="" value="92374873"/>
				</div>
				<div class="inputBox">
					<p>旧款图片</p>
					<div class="imageBox" id="quan">
						<!--<div class="floatl">-->
							<!--<img src="__STYLE__/img/bf02.png" />-->
							<!--&lt;!&ndash;放在第二个img数据&ndash;&gt;-->
							<!--<img src="__STYLE__/img/back.jpg" />-->
						<!--</div>-->
						<!--<div class="floatl">-->
							<!--<img src="__STYLE__/img/bf02.png" />-->
							<!--<img src="__STYLE__/img/back.jpg" />-->
						<!--</div>-->
						<!--<div class="floatl">-->
							<!--<img src="__STYLE__/img/bf02.png" />-->
							<!--<img src="__STYLE__/img/back.jpg" />-->
						<!--</div>-->
						<!--<div class="floatl">-->
							<!--<img src="__STYLE__/img/bf02.png" />-->
							<!--<img src="__STYLE__/img/back.jpg" />-->
						<!--</div>-->
						<!--<div class="floatl">-->
							<!--<img src="__STYLE__/img/bf02.png" />-->
							<!--<img src="__STYLE__/img/back.jpg" />-->
						<!--</div>-->
						<!--<div class="floatl">-->
							<!--<img src="__STYLE__/img/bf02.png" />-->
							<!--<img src="__STYLE__/img/back.jpg" />-->
						<!--</div>-->
						<!--<div class="clearl"></div>-->
					</div>
					
				</div>	
				<div class="nextBtn">
					<input type="image" src="__STYLE__/img/use02.png" />
				</div>
			</div>
		</div>
		<!--使用第2步-->
		<div id="use2" style="display: none;">
			<div class="use2">
				<img src="__STYLE__/img/use03.png" />
				<div class="star">
					<img src="__STYLE__/img/use05.png" />
				</div>
				<button class="usYes"></button>
				<button class="usNo"></button>
			</div>
		</div>
		<!--使用第3步-->
		<div id="use3" style="display: none;">
			<div class="rback">
				<input type="image" src="__STYLE__/img/return.png" />
			</div>
			<div class="use3">
				<div class="usTitle">
					<img src="__STYLE__/img/use06.png" />
				</div>
				<div class="twoUse">
					<p id="ho_code">活动码编号：92837625</p>
					<p id="hd_type">活动码类型：智能活动码</p>
				</div>
				<div class="inputBox">
					<p>城市代码：</p>
					<input type="text" id="city" placeholder="请输入城市代码"/>
				</div>
				<div class="inputBox">
					<p>购买产品的型号：</p>
					<input type="text" id="new_brand" placeholder="请输入购买产品的型号"/>
				</div>
				<div class="useTip">
					<p>温馨提示：城市代码请咨询门店工作人员后填写</p>
				</div>
				<div class="nextBtn">
					<input type="image" src="__STYLE__/img/use02.png" />
				</div>
			</div>
			
		</div>	
		<!--使用第4步-->
		<div id="use4" style="display: none;">
			<div class="use4">
				<img src="__STYLE__/img/use07.png" />
				<div class="star">
					<img src="__STYLE__/img/use05.png" />
				</div>
				<button></button>
			</div>
		</div>

		<script>
		    //微信加入聊天
			function audioAutoPlay(id,v){
				var audio = document.getElementById(id);
				    audio.play();
				    if(v==0)
				    {
				    	audio.pause();
				    }
				    document.addEventListener("WeixinJSBridgeReady", function () {
				            audio.play();
				            if(v==0)
						    {
						    	audio.pause();
						    }
				    }, false);
				}    
			audioAutoPlay('bg');
	    </script>
	    <script type="text/javascript" src="__STYLE__/js/share-code-pop.js" ></script>
	    <script type="text/javascript" src="__STYLE__/js/tools.min.js" ></script>
	    <script type="text/javascript" src="__STYLE__/js/upImg.js" ></script>
	    <script type="text/javascript" src="__STYLE__/js/suggestion-buy.js" ></script>
		<script type="text/javascript" src="__STYLE__/js/index.js" ></script>
		<!--删除不良信息-->
		<div class="delete2" hidden="hidden"></div>
	</body>
</html>
