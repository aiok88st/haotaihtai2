$(function(){
    $('input').focusin(function(){
       $('.rback').hide();
    });
    $('input').focusout(function(){
        $('.rback').show();
    });
	//删除不良信息
	$('.delete1').prevAll().remove();
	$('.delete2').nextAll().remove();
	//音乐
	var music = 0;
	var musicOpen = true;
	var musicTween = setInterval(function() {
		music += 2;
		$('#music').css('transform', "rotate(" + music + "deg)");
		if(music == 360) {
			music = 0;
		}
	}, 10);
	$('#music').on('click', function() {
		if(musicOpen == true) {
			musicOpen = false;
			clearInterval(musicTween);
			$('#bg')[0].pause();
		} else {
			musicOpen = true;
			musicTween = setInterval(function() {
				music += 2;
				$('#music').css('transform', "rotate(" + music + "deg)");
				if(music == 360) {
					music = 0;
				}
			}, 10);
			$('#bg')[0].play();
		}
	});
    showHome();

});
//显示首页
function showHome(){
	$('#homepage').show();
	//时间控制
	$('.flower').remove();
	var sTime = 250;
	var oTime = 1000;
	$('.home2').show().find('img').addClass('animated bounceIn');
	setTimeout(function(){
		$('.home4').show().find('img').addClass('animated bounceIn');
		setTimeout(function(){
			$('.home5').show().find('img').addClass('animated bounceIn');
			setTimeout(function(){
				$('.home3').show().find('img').addClass('animated rotateInDownRight');
				$('.oldNew').show().addClass('animated rotateInDownLeft');
				$('.look').show().addClass('animated rotateInUpRight');
				setTimeout(function(){
					$('.home1').show().find('img').addClass('animated fadeIn');
					$('.homep').show().addClass('animated fadeInDown');
				},oTime);
			},sTime);
		},sTime);
	},sTime);
	var nIndex = 1;
	var numb = 0;
	var eTime = setInterval(function(){
		flower('#homepage',nIndex,numb,3000);
		nIndex++;
		numb++;
		if(nIndex==4)
		{
			nIndex=1;
		}
	},750);
	$('.oldNew').on('click',function(){
		$('#homepage').hide();
		$('.flower').remove();
		clearInterval(eTime);
		$('.home').hide().find('img').removeClass();
		$('.homep').hide().removeClass('animated fadeInDown');
		$('.oldNew').hide().removeClass('animated rotateInDownLeft');
		$('.look').hide().removeClass('animated rotateInUpRight');
		mycodes();
	});
	$('.look').on('click',function(){
		$('#homepage').hide();
		$('.flower').remove();
		clearInterval(eTime);
		$('.home').hide().find('img').removeClass();
		$('.homep').hide().removeClass('animated fadeInDown');
		$('.oldNew').hide().removeClass('animated rotateInDownLeft');
		$('.look').hide().removeClass('animated rotateInUpRight');
		showHome();
	});
}
//烟花
function flower(id,n,numb,time){
	var html = '<div class="flower flower'+n+' flower'+numb+'"><div class="flIn"><img src="'+APP_URL+'/img/fl1.png" /></div></div>'
	$(id).append(html);
	setTimeout(function(){
		$('.flower'+numb).remove();
	},time);
	
}
