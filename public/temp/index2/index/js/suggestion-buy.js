//评价
function sug01(){
	$('#suggestion').show();
	//分数
	var serStar = 0;
	var proStar = 0;
	$('#suggestion').find('.sbPro').find('img').on('click',function(){
		var index = $(this).index();
		proStar = index;
		for(var i=0;i<=4;i++)
		{
			if(i<=index)
			{
				$('#suggestion').find('.sbPro').find('img').eq(i).attr('src',APP_URL+'/img/sg03.png');
			}else{
				$('#suggestion').find('.sbPro').find('img').eq(i).attr('src',APP_URL+'/img/sg02.png');
			}
			
		}
	});
	$('#suggestion').find('.svSer').find('img').on('click',function(){
		var index = $(this).index();
		serStar = index;
		for(var i=0;i<=4;i++)
		{
			if(i<=index)
			{
				$('#suggestion').find('.svSer').find('img').eq(i).attr('src',APP_URL+'/img/sg03.png');
			}else{
				$('#suggestion').find('.svSer').find('img').eq(i).attr('src',APP_URL+'/img/sg02.png');
			}
			
		}
	});
	//返回
	$('#suggestion .rback').on('touchstart',function(){
		$('#suggestion').hide();
		$('#myCode').show();
	});
	//提交
	$('#suggestion .nextBtn').on('click',function(){
        //提交后台
        var data = {};
        data.proStar = proStar+1;
        data.serStar = serStar+1;
        data.content = $('#content').val();
        var img = [];
        $('.newImg img').each(function(){
            var img_src = $(this).attr('src');
            if(img_src != ''){
                img.push(img_src);
            }
        });
        data.new_img = img;
        data.pid = proIndex;
        upLoading();
        $.post(pj, data, function(res) {
            closeLoading();
            if (res.code == 1) {
                $('#suggestion').hide();
                $('#suggestSuccess').show();
                $('#suggestSuccess button').on('click',function(){
                    $('#suggestSuccess').hide();
                });
            } else {
                popWin(3,res.msg);
            }

        }, 'json');

	});
//	//上传图片
	var _upFile = document.getElementById("file1");
	_upFile.addEventListener("change", function() {
	
		if(_upFile.files.length === 0) {
			popWin(3,"请拍照");
			return;
		}
		var oFile = _upFile.files[0];
		//if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }
	
		/*  if(oFile.size>5*1024*1024){
		 message(myCache.par.lang,{cn:"照片上传：文件不能超过5MB!请使用容量更小的照片。",en:"证书上传：文件不能超过100K!"})
	
		 return;
		 }*/
		if(!new RegExp("(jpg|jpeg|png)+", "gi").test(oFile.type)) {
			alert("照片上传：文件类型必须是JPG、JPEG、PNG");
			return;
		}
		upLoading();
		var reader = new FileReader();
		reader.onload = function(e) {
			var base64Img = e.target.result;
			//压缩前预览
			
			//--执行resize。
			var _ir = ImageResizer({
				resizeMode: "auto",
				dataSource: base64Img,
				dataSourceType: "base64",
				maxWidth: 714 //允许的最大宽度
					,
				maxHeight: 1334 //允许的最大高度。
					,
				onTmpImgGenerate: function(img) {
	
				},
				success: function(resizeImgBase64, canvas){
					closeLoading();
					var html = "";
						html += '<div class="floatl"><img src="'+APP_URL+'/img/bf02.png" /><div class="setIn newImg"><img src="'+resizeImgBase64+'" />';
						html += '"/></div><button></button></div>';
					$('#suggestion .setImg').append(html);
					$('#suggestion .setIn').nextAll('button').on('click',function(){
						$(this).parent('.floatl').remove();
						if($('#suggestion .setImg').children('.floatl').length<6)
						{
							$('#suggestion .sgup').show();
						}
					});
					$('#suggestion .setIn').on('click',function(){
						var self = $(this);
						bigImg(self.find('img').attr('src'));
					});
					if($('#suggestion .setImg').children('.floatl').length>=6)
					{
						$('#suggestion .sgup').hide();
					}
					//赋值到隐藏域传给后台
					// $('#imgOne').val(resizeImgBase64.substr(22));
				},
				debug: true
			});
	
		};
		reader.readAsDataURL(oFile);
	}, false);
}
//使用第一步
function useStep1(pid){
    //获取订单信息
    $.get(my_order,{"pid":pid},function(res){
        var data = JSON.parse(res);
        $("#name1").attr('value',data.name);
        $("#phone1").attr('value',data.phone);
        $("#old1").attr('value',data.old_brand);
        var html="";
        for(item in data.old_img){
            html +='<div class="floatl">';
            html +='<img src="'+APP_URL+'/img/bf02.png" />';
            html +='<img src="'+data.old_img[item]+'" />';
            html +='</div>';
        }
        html +='<div class="clearl"></div>';
        $('#quan').html(html);
        $('#quan').attr('hd_code',data.code);
		$('#use1 .use102 .inputBox .imageBox .floatl > img:nth-child(2)').on('click', function() {
			bigImg($(this).attr('src'));
		});
    });

	$('#use1').show();

	//使用
	$('#use1').find('.rback').on('touchstart',function(){
		$('#use1').hide();
		$('#myCode').show();
	});
	//确定使用
	$('#use1 .nextBtn').on('click',function(){
		if(proIndex==1)
		{
			$('#use2 .use2').children('img').attr('src',APP_URL+'/img/use03.png');
		}else if(proIndex==2){
			$('#use2 .use2').children('img').attr('src',APP_URL+'/img/use04.png');
		}
		$('#use2').show();
		
		$('#use2 .usNo').on('click',function(){
			$('#use2').hide();
		});
		$('#use2 .usYes').on('click',function(){
			useStep3();
		});
	});
}
function useStep3(){
    if(proIndex==1) {
        $('#hd_type').html('活动码类型：智能活动码');
    }else if(proIndex==2){
        $('#hd_type').html('活动码类型：手摇活动码');
    }
    var code = $('#quan').attr('hd_code');
    $('#ho_code').html('活动码编号：'+code);

	$('#use1').hide();
	$('#use2').hide();
	$('#use3').show();
	//使用
	$('#use3').find('.rback').on('touchstart',function(){
		$('#use1').show();
		$('#use3').hide();
	});
	//确定使用
	$('#use3 .nextBtn').on('click',function(){
		useStep4();
	});
}
function useStep4(){
	$('#use3').hide();
	$('#use4').show();
    var data = {};
    data.city_code = $('#city').val();
    data.new_brand = $('#new_brand').val();
	if(proIndex==1)
	{
        data.pid = 1;
        use_ticket(data,function(res){
            if (res.code == 1) {
                $('#use4 .use4').children('img').attr('src',APP_URL+'/img/use08.png');
            } else {
                layer.msg(res.msg,{time: 3000});
            }
        });

	}else if(proIndex==2){
        data.pid = 2;
        use_ticket(data,function(res){
            if (res.code == 1) {
                $('#use4 .use4').children('img').attr('src',APP_URL+'/img/use07.png');
            } else {
                layer.msg(res.msg,{time: 3000});
            }
        });
	}

	$('#use4 button').on('click',function(){
		$('#use4').hide();
		$('#myCode').show();
		if(proIndex==1)
		{
			$('#myCode .fiveYuan').attr('index',2);
			$('#myCode .fiveYuan').find('p').text("评价");
		}else if(proIndex==2){
			$('#myCode .threeYuan').attr('index',2);
			$('#myCode .threeYuan').find('p').text("评价");
		}
	});
}

//提交后台
function use_ticket(data,callback){
    upLoading();
    $.post(use_tickets, data, function(res) {
        closeLoading();
        callback(res);

    }, 'json');
}