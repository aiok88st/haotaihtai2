/*获取随机字符串*/
function randChar(len) {
	var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz',
		max = str.length - 1,
		arr = str.split(''),
		rstr = Array();
	var len = len ? len : 6;
	for (var i = 0; i < len; i++) {
		var num = generateMixed(max);
		rstr.push(arr[num]);
	}
	return rstr.join('');
}
//获得随机数
function generateMixed(n) {
	var n = n ? n : 10;
	var res = Math.ceil(Math.random() * n);
	return res;
}
//in_array值判断
function in_array(str, arr) {
	if (typeof(arr) !== 'object') return false;
	if (str == '') return false;
	var state = false;
	for (var i = 0; i < arr.length; i++) {
		if (arr[i] == str) {
			state = true;
			break;
		}
	}
	return state;
}
//，号,。号转换
function commas(_this) {
	var vals = $(_this).val();
	if (vals.length > 2) {
		vals = vals.replace(/[‘，。]/g, ',');
		$(_this).val(vals);
	}
}
/*字数限制*/
function keyLength(_this, len, key) {
	var value = $(_this).val();
	if (value.length > 80) {
		$(_this).val(value.substr(0, 80));
		$('body #key').eq(key).text(0);
	}else {
		$('body #key').eq(key).text(len - value.length);
	}
}
/*
* floatTo() 	保留小数位
* str 			字符
* counts		保留小数位
*/
function floatTo(str, counts) {
	var vals = str;
	if (!/^\d+(\.\d+)?$/.test(vals)) {
		vals = str;
	}
	if (!/^[0-9]{0,20}$/.test(str)) {
		str = String(str);
		str = str.split('.');
		//保留两位小数
		if (str.length == counts) {
			vals = str[0]+'.'+str[1].substr(0,counts);
		}else {
			vals = str;
		}
	}
	return vals;
}
//去除空格
function trim(str){   
    str = str.replace(/^(\s|\u00A0)+/,'');   
    for(var i=str.length-1; i>=0; i--){   
        if(/\S/.test(str.charAt(i))){   
            str = str.substring(0, i+1);   
            break;   
        }   
    }   
    return str;   
}
/*Ajax函数参数说明
* getUrl	请求地址
* getType	请求类型（POST,GET）
* getData	数据
* getInfo	成功后的提示
* Url	跳转地址
*/
function Ajaxs(getUrl, getType, getData, callback) {
	bpop.addLoading(true);
	$('body .btn').prop('disabled', true);
	$.ajax({
		url: getUrl,
		cache: false,
		dataType: 'JSON',
		type: getType,
		data: getData,
		success: function(data) {
			$('body .btn').prop('disabled', false);
			if (data == null || data == undefined || data == '') {
				bpop.tip('数据返回错误', 2, 1);
				return false;
			}
			if (data.code == 1) {

				if (typeof(callback) == 'function') {
					callback(data);
				}else {
					bpop.tip(data.msg, 1, 1, data.url, true);
				}
				return true;
			}else {
				bpop.tip(data.msg, 2, 1);
				return false;
			}
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			$('body .btn').prop('disabled', false);
			switch(XMLHttpRequest.status) {
				case 404 : bpop.tip('404错误', 2, 1); break;
				case 500 : bpop.tip('500错误', 2, 1); break;
			}
			return false;
		}
	});
}
//移除重复值
function array_unique(array) {
	if (typeof(array) !== 'object') return array;
	if (array.length <= 0) return array;
	var len = array.length;
	var run = Array();
	for (i = 0; i < len; i++) {
		if (!in_array(array[i], run)) {
			run.push(array[i]);
		}
	}
	return run;
}
/*文本复制*/
function copyText(obj, text) {
	obj.zclip({
		path : web_dir + '/Public/common/js/ZeroClipboard.swf',
		copy : text
	});
}