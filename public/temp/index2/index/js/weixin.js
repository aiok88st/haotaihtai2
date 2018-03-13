//微信分享
$.ajax({
    type:'GET',
    url:weixinLink,
    dataType:'JSON',
    success:function(res){
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId:res.appId, // 必填，公众号的唯一标识

            timestamp: res.timestamp, // 必填，生成签名的时间戳

            nonceStr:res.nonceStr, // 必填，生成签名的随机串

            signature:res.signature,// 必填，签名，见附录1

            jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

        });
        wx.ready(function () {
            wx.onMenuShareTimeline({
                title: '好太太集团辞旧迎新',
                desc: '诚邀您参与好太太集团换购季活动',
                link: res.url,
                imgUrl: 'https://haotaitai.hengdikeji.com/temp/index2/index/img/fenxiang.png',
                trigger: function (res) {
                },
                success: function (res) {
                
                },
                cancel: function (res) {
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareAppMessage({
                title: '好太太集团辞旧迎新',
                desc: '诚邀您参与好太太集团换购季活动',
                link: res.url,
                imgUrl: 'https://haotaitai.hengdikeji.com/temp/index2/index/img/fenxiang.png',
                trigger: function (res) {
                },
                success: function (res) {
                },
                cancel: function (res) {
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        })
    }
});