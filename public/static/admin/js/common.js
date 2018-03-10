function getTest(){
    var data=[];
    $('.movie_box').each(function(){
        var box=$(this).children('.wjdc_list');
        var type=box.find('.tip_wz').text();
        var title=box.find('.btwenzi').text();
        var score=box.children('.scot').val();
        var input=box.children('.input');
        var a={};
        if(type=="【单选】"){
            var types=1;
        }else if(type=="【多选】"){
            var types=2;
        }else if(type=="【判断】"){
            var types=3;
        }else if(type=="【填空】"){
            var types=4;
        }
        a.type=types;
        a.title=title;
        a.score=score;
        a.input=[];
        input.each(function(){
            var f=$(this).find('input');
            var check={};
            if(type=="【单选】" || type=="【多选】" || type=="【判断】"){
                check.val= f.val();
                if(f.is(":checked")){
                    check.answer=1;
                }else{
                    check.answer=0;
                }
            }
            a.input.push(check);
        })
        data.push(a);
    });
    return data;
}