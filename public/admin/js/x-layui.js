/*弹出层*/
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
$(function(){
    $('.check_all').click(function(){
        if( $(this).is(':checked') ){
            $(".check_one").prop("checked", true);
        }else{
            $(".check_one").prop("checked", false);
        }

    });
});
function x_admin_show(title,url,w,h,callback){
	if (title == null || title == '') {
		title=false;
	}
	if (url == null || url == '') {
		url="404.html";
	}
	if (w == null || w == '') {
		w=800;
	}
	if (h == null || h == '') {
		h=($(window).height() - 50);
	}
	layer.open({
		type: 2,
		area: [w+'px', h +'px'],
		fix: false, //不固定
		maxmin: true,
		shadeClose: true,
		shade:0.4,
		title: title,
		content: url,
        cancel:function(index){
            layer.close(index);
            if (typeof(callback) == 'function') {
                callback();
            }
        }
	});

}

/*关闭弹出框口*/
function x_admin_close(){
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.close(index);
}
/*Ajax函数参数说明
 * getUrl	请求地址
 * getType	请求类型（POST,GET）
 * getData	数据
 * getInfo	成功后的提示
 * Url	跳转地址
 */
function Ajaxs(getUrl, getType, getData, callback,isupdate){
    var load = layer.load(2, {time: 10*1000});
    $.ajax({
        url: getUrl,
        cache: false,
        dataType: 'JSON',
        type: getType,
        data: getData,
        success: function(data) {
            layer.close(load);
            if (data == null || data == undefined || data == '') {
                layer.msg('数据返回错误', {icon: 5 ,time:1000});
                return false;
            }
            if(data.token){
                token=data.token;
            }
            if (data.code == 1) {
                if (typeof(callback) == 'function') {

                    callback();

                    layer.alert(data.msg, {icon: 6},function (eq) {
                        if(isupdate!="parentNotClose"){
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        }else{
                            layer.close(eq)
                        }
                    });
                }else {
                    layer.alert(data.msg, {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                        if(index){
                            parent.layer.close(index);
                            if(isupdate=="NotReload"){
                                window.parent.callback();
                                return false;
                            }
                            parent.location.reload();
                        }else{
                            layer.closeAll('dialog');
                            if(isupdate=="NotReload"){
                                window.parent.callback();
                                return false;
                            }
                            parent.location.reload();
                        }
                   });
                }
                return true;
            }else {

                layer.msg(data.msg, {icon: 5,time:1000});
                return false;
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {

            switch(XMLHttpRequest.status) {
                case 404 : layer.msg("404错误", {icon: 5}); break;
                case 500 : layer.msg("505错误", {icon: 5}); break;
            }
            return false;
        }
    });
}
//通用ajax获取数据列表
function ajaxList(urls, callback, datas) {
    layui.use('layer', function(){
        var layer = layui.layer;
        //防止经常重复点击发送请求
        if (ajax_config.code == 0) return false;
        ajax_config.code = 0;
        ajax_config.urls = urls;//记录请求地址

        var index = layer.load(2, {time: 10*1000});
        $.getJSON(urls, datas, function(data) {
            ajax_config.code = 1;
            if (data.code == 1) {
                layer.close(index);
                //回调函数
                callback(data);

            }
        });
    });
}
//获取选中值
function runchecked(type) {
    var vals =new Array();
    $('body .'+type+':checked').each(function() {
        vals.push($(this).val());
    });
    vals = vals.join(',');
    return vals;
}
//通用删除
function dataDel(url, id, callback, imm,type) {
    var idlist = '';
    if (id) {
        idlist = id;
    }else {
        idlist = runchecked('ids');
    }

    if (idlist == '') {
        layer.msg('请先选择', {icon: 7});
    }else {

        var msg="确定要删除选中数据吗";
        if(type){
            msg=type;
        }
        layer.confirm(msg,function(){
            $.post(url, { 'idlist' : idlist }, function(data) {
                if (data == null || data == undefined || data == '') {
                    layer.msg('请先选择', {icon: 5});
                    return false;
                }
                if (data.code == 1) {
                    layer.msg(data.msg, {icon: 6});

                    //删除数据
                    if (!isNaN(idlist)) {
                        $('#items .tr-'+idlist).remove();
                    }else {
                        idlist = idlist.split(',');
                        for (x in idlist) {
                            $('#items .tr-'+idlist[x]).remove();
                        }
                    }
                    //判断是否还有剩余数据，如果没有则初始化第一页数据
                    if (imm) {
                        if (typeof(callback) == 'function') {
                            callback();
                        }
                    }else {
                        if ($('#items .tr').size() <= 0) {
                            if (typeof(callback) == 'function') {
                                callback();
                            }else {
                                window.location.reload();
                            }
                        }
                    }
                }else {
                    layer.msg(data.msg, {icon: 5});
                }
            }, 'JSON');
        });
    }
}
var chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
function generateMixed(n) {
    var res = "";
    for(var i = 0; i < n ; i ++) {
        var id = Math.ceil(Math.random()*35);
        res += chars[id];
    }
    return res;
}