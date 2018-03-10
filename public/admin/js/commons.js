//弹窗函数对象
function bpop() {
	this.speed = 0
}
/**
* 添加弹窗
* info 内容，type类型：(1只有确认)(2确认-取消), callback,默认false
*/
bpop.prototype.add = function(info, type, callback) {
	this.clean();
	var btn = '<span class="btn-item btn-item-red btn-confirm" onclick="bpop.clean('+callback+');">确认</span>';
	btn = type == 2 ? btn = btn + '<span class="btn-item btn-cancel" onclick="bpop.clean();">取消</span>' : btn;
	var html = '<div class="bpop"><div class="bpop-center"><div class="bpop-title">网站提醒</div><div class="bpop-body">'+info+'</div><div class="bpop-btn">'+btn+'</div></div></div><div class="zbodys"></div>';
	$('body').append(html);
	this.fixed();
}
//定位
bpop.prototype.fixed = function() {
	this.center('bpop');
	$('body .bpop').addClass('bpop-css3');
}
//清除
bpop.prototype.clean = function(callback) {
	$('body .bpop').removeClass('bpop-css3');
	$('body .zbodys, body .bpop-load, body .bpop-tip').remove();
	$('body .bpop').fadeOut(function() {
		$(this).remove();
	}, 0);
	$('body .btn').attr('disabled', false);
	//如果存在回调函数则启用
	if (callback) {
		callback();
	}
}
//loading加载
bpop.prototype.addLoading = function(z) {
	this.clean();
	$('body .zbodys, body .bpop, body .bpop-load').remove();

	$('body').append('<div class="bpop-load"></div>');
	if (z) $('body').append('<div class="zbodys"></div>');
	this.center('bpop-load');
}
//loading加载
bpop.prototype.parentLoading = function(z) {
	$(window.top.document).find('body .zbodys, body .bpop-load, body .bpop-tip').remove();
	var loads = $('<div class="bpop-load" />');
	$(window.top.document).find('body').append(loads);
	if (z) $(window.top.document).find('body').append('<div class="zbodys" />');
	$(window.top.document).find(loads).css({
		'left' : ($(window.top).width()/2 - $(window.top.document).find(loads).width()/2) + 'px',
		'top' : ($(window.top).height()/2 - $(window.top.document).find(loads).height()/2) + 'px'
	});
}
//tip提醒 1 正确,2提示,3错误
bpop.prototype.tip = function(info, status, times, url, z) {
	clearTimeout(this.speed);
	this.clean();
	$('body .bpop-tip').remove();
	//是否启用遮罩
	var cls = status == 2 ? 't' : status == 3 ? 'n' : '';
	var html = '<div class="bpop-tip"><div class="bpop-tip-center"><span class="bpop-s bpop-'+cls+'"></span><span class="bpop-font">'+info+'</span><div class="bpop-clear"></div></div></div>';
	$('body').append(html);
	if (z) $('body').append('<div class="zbodys" />');
	$('body .btn').attr('disabled', true);
	this.center('bpop-tip');
	//自动关闭
	this.speed = setTimeout(function() {
		if (url) {
			//如果是重载
			if (url == 'load' || url == '?') {
				window.location.reload();
			}else {
				location.href = url;
			}
		}else {
			bpop.clean();
		}
	}, times*1000);
}
//元素居中
bpop.prototype.center = function(cls) {
	$('body .'+cls).css({
		'left' : ($(window).width()/2 - $('body .'+cls).width()/2) + 'px',
		'top' : ($(window).height()/2 - $('body .'+cls).height()/2) + 'px'
	});
}
//创建对象
var bpop = new bpop();

//cookie对象操作
function cookie() { }
/*
* c_name	cookie名称
* value		cookie值
* expiredays	时间
*/
cookie.prototype.create = function(c_name, value, expiredays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie = c_name+'='+escape(value)+((expiredays==null) ? "" : "; expires="+exdate.toGMTString())+"; path=/";
}
//创建cookie c_name
cookie.prototype.create = function(c_name) {
	var date = new Date();
	date.setTime(date.getTime() - date.getTime());
	document.cookie = c_name + "=a; expires=" + date.toGMTString()+"; path=/";
}
//删除cookie
cookie.prototype.del = function(c_name) {
	var date = new Date();
	date.setTime(date.getTime() - date.getTime());
	document.cookie = c_name + "=a; expires=" + date.toGMTString()+"; path=/";
}
//获取cookie
cookie.prototype.get = function(c_name) {
	if (document.cookie.length > 0) {
		c_start = document.cookie.indexOf(c_name+"=");
		if (c_start != -1) {
			c_start = c_start + c_name.length+1;
			c_end = document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end = document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}else {
			return null;
		}
	}else {
		return null;
	}
}
var cookie = new cookie();

//弹窗加载对象
function dpop() {}
/*
* width		宽度
* height	高度
* bremove	是否使用遮照
* reloads	是否刷新
*/
dpop.prototype.add = function(width, height, title, url, bremove, reloads, screens) {
	var width = String(width);
	var height = String(height);
	if (width == '' && height == '')  {
		width = '300px';
		height = '220px';
	}else {
		//判断有无px或者
		if (width.indexOf('%') == -1) {
			width = width+'px';
			height = height+'px';
		}
	}
	//生成唯一class码
	var cls = 'cloud-class-'+Math.ceil(Math.random()*1000);
	url = url+'#'+cls;
	var pops = $('<div id="dpop" class="'+cls+'" style="width:'+width+';height:'+height+';"></div>');
	$('body').append(pops);
	pops.html('<div class="dpop_title">'+title+'<div class="dpop_close" title="关闭窗口" onclick="dpop.close(\''+cls+'\', '+reloads+');"></div><div class="dpop_fd" title="放大窗口"></div><div class="dpop_sx" title="缩小窗口"></div></div><div class="frame"><iframe scrolling="0" width="100%" height="98%" src="'+url+'" frameborder="0" name="iframe_pop"></iframe></div>');
	//是否需要遮照层
	if (bremove) $('body').append('<div class="zbody '+cls+'"></div>');
	//判断是第几个窗口
	var height = pops.height();
	pops.find('.frame').css({ 'height' : (height-31)+'px' });
	//将窗口定位
	this.fixed(pops, height);
	this.divmove(pops);
	if (screens)
		this.winsf(pops, $(window).width(), $(window).height());
}
//添加窗口，不是iframe
dpop.prototype.addbody = function(width, height, title, html, reloads) {
	this.closeAll();
	//生成唯一class码
	var cls = 'cloud-class-'+Math.ceil(Math.random()*1000);
	$('body').append('<div class="zbody '+cls+'"></div>');
	var pops = $('<div id="dpop" class="'+cls+'" style="width:'+width+'px;height:'+height+'px;" />');
	pops.html('<div class="dpop_title">'+title+'<div class="dpop_close" title="关闭窗口" onclick="dpop.close(\''+cls+'\', '+reloads+');"></div></div><div class="bodys">'+html+'</div>');
	$('body').append(pops);
	pops.find('.bodys').css({ 'height' : (height-31)+'px' });
	//this.divmove(pops);
	//将窗口定位
	this.fixed(pops, height);
}
//窗口定位
dpop.prototype.fixed = function(obj, height) {
	var left = ($(window).width()/2)-obj.width()/2;
	var top = ($(window).height()/2)-(obj.height()/2);
	if (top < 0) {
		top = 0;
	}
	obj.css({'left':left+'px','top':top+'px','zIndex':999});
}
//关闭窗口
dpop.prototype.close = function(obj, reloads) {
	$('.'+obj).remove();
	$('body .dropdown-toggle').dropdown();
	//判断是否是函数
	if (typeof(reloads) == 'function') {
		//如果是函数，则执行回调函数
		reloads(1);
	}else {
		if (reloads) window.location.reload();
	}
}
//关闭所有窗口
dpop.prototype.closeAll = function() {
	$('body #dpop, body .zbody').remove();
}
//关闭父窗口
dpop.prototype.parentClose = function() {
	$(window.parent.document).find('body #dpop, body .zbody').remove();
	$('body .dropdown-toggle').dropdown();
}
//窗口移动
dpop.prototype.divmove = function(obj) {
	var fwidth = obj.width();
	var fheight = obj.height();
	var objleft;
	var objtop;
	//给当前的div的dtitle元素绑定鼠标按下事件
	obj.dblclick(function(event) {
		dpop.winsf(obj, fwidth, fheight);
	});
	obj.find('.dpop_fd, .dpop_sx').click(function(event) {
		dpop.winsf(obj, fwidth, fheight);
	});
	obj.mousedown(function(event) {
		event.preventDefault();
		event.stopImmediatePropagation();
		obj.css({'width':obj.width()+'px','height':obj.height()+'px'});
		obj.find('iframe').hide();
		$('body #dpop').css({'zIndex':998});
		obj.css({'zIndex':999});
		var offset = $(this).offset();
		var x = event.clientX - offset.left;
		var y = event.clientY - offset.top + $(window).scrollTop();
		$(document).mousemove(function(event) {
			event.preventDefault();
			var _left = event.clientX - x;
			var _top = event.clientY - y;
			obj.css('left',_left+'px');
			if (_top < 0) {
				obj.css('top','0px');
			}else {
				obj.css('top',_top+'px');
			}
			return false;
		});
		obj.mouseup(function() {
			$(document).unbind()					//解除
			obj.find('iframe').show();
			return false;
		});
	});
}
dpop.prototype.winsf = function(obj, fwidth, fheight) {
	var width = $(window).width();
	var height = $(window).height();
	if (obj.width() != width) {
		//保存放大时的位置
		objleft = obj.css('left');
		objtop = obj.css('top');
		obj.css({'width':width+'px','height':height+'px','left':'0px','top':'0px'});

		obj.find('.frame').css({ 'height' : (height-31)+'px' });

		obj.find('.dpop_fd').hide();
		obj.find('.dpop_sx').show();
	}else {
		obj.css({'width':fwidth+'px','height':fheight+'px','left':objleft,'top':objtop});

		obj.find('.frame').css({ 'height' : (fheight-31)+'px' });

		obj.find('.dpop_fd').show();
		obj.find('.dpop_sx').hide();
	}
}
//创建对象
var dpop = new dpop();

//地区选择器,使用方法，引入地区库,初始化init
function regions(cls, id, num, top_id, types) {
    this.cls = cls;//元素
    this.id = id ? id : 0;
    this.num = num ? num : 5;//层级
    this.top_id = top_id ? top_id : 0;//最多到顶级ID
    this.types = types ? types : '';//最多到顶级ID
}
//地区选择初始化
regions.prototype.init = function() {
	var list = this.prevList(this.id);
	if (list.length > 0 && this.types == 'edit') {
		this.updateList(list);
	}else {
		var option = '<option value="0">请选择</option>';
	    for(x in region_list) {
	        if (region_list[x].parent_id == this.id) {
	            option = option + '<option value="'+region_list[x].id+'">'+region_list[x].name+'</option>';
	        }
	    }
	    $(this.cls).html(option);
	    this.areaEvent();
	}
}
//选择事件
regions.prototype.areaEvent = function() {
    var pthis = this;
    var len = $('body '+pthis.cls).size();
	$('body '+pthis.cls).change(function(event) {
        event.stopImmediatePropagation();
        var inx = $(this).index();
        if (inx < pthis.num-1) {
	        pthis.loadArea($(this), $(this).val());
    	}
    });
}
//加载下拉菜单
regions.prototype.loadArea = function(_this, id) {
    _this.nextAll(this.cls).remove();
    if (id <= 0) return false;
    var html = '<select class="'+$(this.cls).attr('class')+'"><option value="0">请选择</option>';
    var list = Array();
    var i = 0;
    for(x in region_list) {
        if (region_list[x].parent_id == id) {
            html = html + '<option value="'+region_list[x].id+'">'+region_list[x].name+'</option>';
            i++;
        }
    }    
    html = html + '</select>';
    if (i > 0) {
        _this.after(html);
        this.areaEvent();
    }
}
//更新城市
regions.prototype.updateList = function(list) {
	var html = '';
	for(x = list.length-1; x >= 0; x--) {
		html = html + '<select class="'+$(this.cls).attr('class')+'"><option value="0">请选择</option>';
		for(j in region_list) {
			if (region_list[j].parent_id == list[x].parent_id) {
				if (region_list[j].id == list[x].id) {
					html = html + '<option value="'+region_list[j].id+'" selected>'+region_list[j].name+'</option>';
				}else {
					html = html + '<option value="'+region_list[j].id+'">'+region_list[j].name+'</option>';
				}
			}
		}
		html = html + '</select>';
	}
	$('body '+this.cls).after(html);
	$('body '+this.cls).eq(0).remove();
	this.areaEvent();
}
//查找所有上级
regions.prototype.prevList = function(id) {
	var list = Array();
	if (id != this.top_id) {
		for(x in region_list) {
			if (region_list[x].id == id) {
				list = list.concat(region_list[x], this.prevList(region_list[x].parent_id));
			}
		}
	}
	return list;
}
//通用删除
function dataDel(url, id, callback, imm) {
    var idlist = '';
    if (id) {
        idlist = id;
    }else {
        idlist = runchecked('idlist');
    }
    if (idlist == '') {
    	bpop.tip('请选中后再操作', 2, 1);
    }else {
    	if (!confirm('确定要删除选中数据吗？')) return false;
    	bpop.addLoading(true);
    	$.post(url, { 'idlist' : idlist }, function(data) {
    		if (data == null || data == undefined || data == '') {
				bpop.tip('数据返回错误', 2, 2);
				return false;
			}
			if (data.code == 1) {
				bpop.tip(data.msg, 1, 1, false, true);
				//删除数据
				if (!isNaN(idlist)) {
					$('#table .tr-'+idlist).remove();
				}else {
					idlist = idlist.split(',');
					for (x in idlist) {
		        		$('#table .tr-'+idlist[x]).remove();
		        	}
				}
	        	//判断是否还有剩余数据，如果没有则初始化第一页数据
	        	if (imm) {
	        		if (typeof(callback) == 'function') {
		        		callback();
	        		}
	        	}else {
	        		if ($('#table .tr').size() <= 0) {
		        		if (typeof(callback) == 'function') {
		        			callback();
		        		}else {
		        			window.location.reload();
		        		}
		        	}
	        	}
			}else {
				bpop.tip(data.msg, 2, 1);
			}
    	}, 'JSON');
    }
}
//通用更新
function dataUpdate(url, id) {
	var idlist = '';
	idlist = id;
	if (!id)
		idlist = runchecked('idlist');
	if (idlist == '' && idlist != '0') {
		bpop.tip('请选中后再操作', 2, 1);
    }else {
        Ajaxs(url, 'POST', { 'idlist' : idlist } );
    }
}
//获取选中值
function runchecked(type) {
    var vals = Array();
    $('body .'+type+':checked').each(function() {
    	vals.push($(this).val());
    });
    vals = vals.join(',');
    return vals;
}
//获取值
function reunval(type) {
    var vals = null;
    for (i = 0; i < $('body .'+type).size(); i++) {
        if ($('body .'+type).eq(i).val() != 'no' && $('body .'+type).eq(i).val() != null) {
            if (vals == '') {
                vals = $('body .'+type).eq(i).val();
            }else {
                vals = vals+','+$('body .'+type).eq(i).val();
            }
        }
    }
    return vals;
}
//获取表单数据
function getFormValue() {
    var datas = Array();
    var data = Array();
    var types,names,status,value,datatype,rule,errorms;
    var getform = $('.getform');
    var h = 0;
    for(var i = 0; i < getform.find('.pinput').size(); i++) {
        status = true;
        types = getform.find('.pinput').eq(i).attr('type');
        names = getform.find('.pinput').eq(i).attr('name');
        datatype = getform.find('.pinput').eq(i).attr('datatype');
        rule = getform.find('.pinput').eq(i).attr('rule');
        errorms = getform.find('.pinput').eq(i).attr('errorms');
        names = names.replace('[]', '');
        for(var j = 0; j < datas.length; j++) {
            if (datas[j][1] == names) {
                status = false;
                break;
            }
        }
        if (!status) continue;
        var check = { 'datatype' : datatype, 'rule' : rule, 'errorms' : errorms };
        datas[h] = [types, names, check];
        h++;
    }
    data = {};
    for(var i = 0; i < datas.length; i++) {
        switch(datas[i][0]) {
            case 'radio' : 
                value = getform.find('.'+datas[i][1]+':checked').val();
                if (datas[i][2].rule != '' && datas[i][2].rule != undefined) {
                	if (!tcheck(value, datas[i][2].datatype, datas[i][2].errorms, datas[i][2].rule)) {
                		return false;
                		break;
                	}
                }else {
                	if (datas[i][2].datatype && datas[i][2].errorms) {
                		if (!tcheck(value, datas[i][2].datatype, datas[i][2].errorms)) {
	                		return false;
	                		break;
	                	}
                	}
                }
                break;
            case 'checkbox' : 
                value = Array();
                getform.find('.'+datas[i][1]+':checked').each(function(j) {
                    value[j] = $(this).val();
                });
                if (datas[i][2].rule != '' && datas[i][2].rule != undefined) {
                	if (!tcheck(value, datas[i][2].datatype, datas[i][2].errorms, datas[i][2].rule)) {
                		return false;
                		break;
                	}
                }else {
                	if (datas[i][2].datatype && datas[i][2].errorms) {
                		if (!tcheck(value, datas[i][2].datatype, datas[i][2].errorms)) {
	                		return false;
	                		break;
	                	}
                	}
                }
                break;
            case 'text' : 
            case 'password' : 
            case 'textarea' : 
            case 'select' : 
            case 'hidden' : 
            	//表单验证
                value = getform.find('.'+datas[i][1]).val();
                if (datas[i][2].rule != '' && datas[i][2].rule != undefined) {
                	if (!tcheck(value, datas[i][2].datatype, datas[i][2].errorms, datas[i][2].rule)) {
                		return false;
                		break;
                	}
                }else {
                	if (datas[i][2].datatype && datas[i][2].errorms) {
                		if (!tcheck(value, datas[i][2].datatype, datas[i][2].errorms)) {
	                		return false;
	                		break;
	                	}
                	}
                }
                break;
            default : value = ''; break;
        }
        var names = "data."+datas[i][1]+"=''";
        eval(names);
        data[datas[i][1]] = value;
    }
    return data;
}
//刷新页面
function reloads(s) {
	if (s) {
		setTimeout(function() {
			window.location.reload();
		}, s*1000);
	}else {
		window.location.reload();
	}
}
//选择文件或图片
function selectFile(url) {
	dpop.add(800, 500, '选择文件', url, true);
}
function imageClose(obj) {
	$('.'+obj).attr('src', $('.'+obj).attr('data-title'));
	$('#'+obj).val('');
}
//初始化
$(function() {
	//复选框选择
	$('#table .checkbox').change(function() {
		if ($('#table .checkbox').prop('checked') == false) {
			$('#table .idlist').prop('checked', false);
		}else {
			$('#table .idlist').prop('checked', true);
		}
	});
	//加载loading图标
	$('body .page-load').click(function() {
		bpop.addLoading();
	});
	topFixed('header-fixed');
	tabs();
});
$(window).scroll(function() {
	topFixed('header-fixed');
});
/*顶部固定导航*/
function topFixed(obj) {
	var obj = $('.'+obj);
	var top = $(window).scrollTop();
	if (top > 15) {
		obj.css({ 'top' : (top-15)+'px' }).addClass('header-fixed-bg');
	}else {
		obj.css({ 'top' : '0px' }).removeClass('header-fixed-bg');
	}
}
//table切换
function tabs() {
	$('body #tabs').hide();
    $('body #tabs').eq(0).show();
	$('.nav-tabs .tab-item').click(function(event) {
		event.stopImmediatePropagation();
		$(this).addClass('active').siblings('.tab-item').removeClass('active');
		$('body #tabs').hide();
		$('body #tabs').eq($(this).index()).show();
	});
}
/*
 * isNumeric()	数字转换
 * _this,		对象
 */
function isNumeric(_this) {
	var value = parseInt($(_this).val());
	if (!/^[0-9]{0,20}$/.test(value)) {
		value = 0;
	}
	$(_this).val(value);
}
/*
 * isAmount()	金额判断类型,价格转换，允许是数字，有小数
 * _this		对象
 */
function isAmount(_this, str) {
	if (str) {
		var vals = str;
		if (!/^\d+(\.\d+)?$/.test(vals)) {
			vals = str;
		}
		if (str != '') {
			var tmp = str.split('');
			if (tmp.length > 1 && tmp[0] == 0 && tmp[1] != '.') {
				vals = 0;
				return vals;
			}
		}
		if (!/^[0-9]{0,20}$/.test(str)) {
			str = String(str);
			str = str.split('.');
			//保留两位小数
			if (str.length == 2) {
				vals = str[0]+'.'+str[1].substr(0,2);
			}else {
				vals = str;
			}
		}
		return vals;
	}else {
		var strs = $(_this).val();
		var vals = strs;
		if (!/^\d+(\.\d+)?$/.test(vals)) {
			vals = 0;
		}
		if (strs && strs != '') {
			var tmp = strs.split('');
			if (tmp.length > 1 && tmp[0] == 0 && tmp[1] != '.') {
				$(_this).val(0);
				return;
			}
		}
		if (!/^[0-9]{0,20}$/.test(strs)) {
			strs = String(strs);
			strs = strs.split('.');
			//保留两位小数
			if (strs.length == 2) {
				vals = strs[0]+'.'+strs[1].substr(0,2);
			}else {
				vals = 0;
			}
		}
		$(_this).val(vals);
	}
}
//通用ajax获取数据列表
function ajaxList(urls, callback, datas) {
    //防止经常重复点击发送请求
    if (ajax_config.status == 0) return false;
    ajax_config.status = 0;
    ajax_config.urls = urls;//记录请求地址
    bpop.addLoading();
    $.getJSON(urls, datas, function(data) {
        bpop.clean();
        ajax_config.status = 1;
        if (data.code == 1) {
            //回调函数
            callback(data);
            $('.page a').click(function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                var urls = $(this).attr('href');
                ajaxList(urls, callback, datas);
            });
        }
    });
}
//显示图片
function showimg(_this, cls) {
    var urls = web_dir+'/';
    var img = $(_this).val();
    if (img.indexOf('http')) {
        img = urls+img;
    }
    $('.'+cls).attr('src', img);
}
//图片预览插件
function imgPreview(imgUrl) {
	$('body .preview, body .preview-body').remove();
	var preview = $('<div class="preview"></div>');
	$('body').append(preview);
	$('body').append('<div class="preview-body" />');
	preview.css({
		'left' : $(window).width()/2-preview.width()/2+'px',
		'top' : $(window).height()/2-preview.height()/2+'px'
	});
	var obj = new Image();
	obj.src = imgUrl;
	obj.onload = function() {
		var w = obj.width > $(window).width()-50 ? $(window).width()-50 : obj.width;
		var h = obj.height;
		if (w > $(window).width()-50) {
			w = $(window).width()-50;
			var radio = 0;
			radio = w / obj.width;
			h = h * radio;
		}
		if (h > $(window).height()-50) {
			h = $(window).height()-50;
			var radio = 0;
			radio = h / obj.height;
			w = w * radio;
		}
		preview.append('<div class="preview-close"></div><img src="'+imgUrl+'" style="width:'+w+'px; height:'+h+'px;" />');
		preview.css({
			'width' : w+'px',
			'height' : h+'px',
			'left' : $(window).width()/2-w/2+'px',
			'top' : $(window).height()/2-h/2+'px',
			'background' : '#fff'
		});
		$('body .preview-body, .preview-close').click(function(event) {
			event.stopImmediatePropagation();
			$('body .preview, body .preview-body').remove();
		});
	}
}
/*增加面包屑导航*/
function breadNav(obj, element, element2) {
	var nav = $('<div class="goods-nav" />');
	var html = '<div class="title" title="点击收缩">模块导航</div><ul>';
	var size = obj.find(element).size();
	for(var i = 0; i < size; i++) {
		html = html + '<li>'+(i+1)+'、'+obj.find(element).eq(i).find(element2).text()+'</li>';
	}
	html = html + '</ul>';
	nav.append(html);
	obj.after(nav);
	nav.find('li').click(function() {
		var inx = $(this).index();
		$('html,body').animate({scrollTop:obj.find(element).eq(inx).offset().top}, 200);
	});
	nav.find('.title').click(function() {
		nav.find('ul').stop().slideToggle('fast');
	});
}