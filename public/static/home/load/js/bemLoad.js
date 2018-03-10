function bemLoad(time,alpha){
	/*
	 * 必须加载的图片
	 * 必须加载的js库jquery
	 */
	/*
	 * time为加载条时间
	 * alpha为背景透明度
	 * imgW为加载图片大小
	 * var load = new bemLoad(200,0.75);创建加载类
	 * load.close();为关闭加载层
	 */
	var html = "";
	 	html += '<div id="bemLoad" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background-color: rgba(0,0,0,'+alpha+');">';
		html += '<div class="bemLoad" style="width: 46px;height: 46px;position: absolute;top: 50%;left: 50%;margin-left: -23px;margin-top: -23px;overflow: hidden;">';
		html += '<img src="'+img_path+'/LoadImg/load.png" /></div></div>';
	$('body').append(html);
	var self = this;
	self.count = 1;
	self.time = setInterval(function(){
		$('.bemLoad img').css('margin-top',-46*self.count+'px');
		self.count++;
		if(self.count == 9){
			self.count =0;
		}		
	},time);
}
bemLoad.prototype.close=function(){
	var self =this;
	clearInterval(self.time)
	$('#bemLoad').remove();
}
