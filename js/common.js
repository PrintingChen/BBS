$(function(){
    var $nums = $('.list li');
    $nums.hover(function(){
        var index = $(this).index();
        var $curr = $nums.eq(index);
        $curr.addClass('curr').siblings().removeClass('curr');
        },function(){
        $nums.removeClass('curr');
    });
    
    //输入框的设置
    $('input[type="text"],input[type="password"]').focus(function(){
        $(this).css({
            'border':'1px solid #0E7BEF',
            'box-shadow':'0 0 3px #0E7BEF'
        });
    });
    $('input[type="text"],input[type="password"]').blur(function(){
        $(this).css({
            'border':'1px solid #ccc',
            'box-shadow':'none'
        });
    });
    
    //搜索框设置
    $('.keyword').focus(function(){
        $(this).css({'outline':'none','border':'1px solid #ccc'});
    });

     //个人中心
    var $person = $('.person_center');
    $person.hover(function(){
        $('.person_list').css('display','block');
    },function(){});

    $('.person_list').hover(function(){
        $person.css('background','#075FB6');
    },function(){
        $(this).css('display','none');
        $person.css('background','');
    });
    
    code();

  
});

/**
 * code() 刷新验证码
 */
function code() {
    $('.vcode').click(function(){
       $(this).attr("src","inc/vcode.php?tm="+Math.random()+"");
    });
}

/**
 * close() 关闭弹框函数
 * @param class_name 类名或id
 * @return void
 */
function close(class_name){
    $('.close').click(function(){
        $('#cover').fadeOut(300);
        $('#tip_win').slideUp(500);
        $(class_name).focus();
    });
    $('#delete_ok').click(function(){
        $('#cover').fadeOut(300);
        $('#tip_win').slideUp(500);
        $(class_name).focus();
    });
}

/**
 * show() 显示弹框函数
 * @param title 弹框的提示标题信息
 * @param msg   提示信息
 * @param pic   提示框的提示图片
 */
function show(title, msg, pic){
    $('#cover').fadeIn(300);
    $('#tip_win').slideDown(500);
    $('.tip_win_title span').html(title);
    $('.tip_delete').html(msg);
    $('.tip_delete').css({'background':'url("../images/'+pic+'") no-repeat 49% 25%'});
}
