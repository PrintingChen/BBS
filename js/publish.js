$(function(){
    //alert($('.title').val());
    $('#publist_form').submit(function(){
        if(!$('.title').val()){
            show('提示', '标题不得为空', 'jinggao.png');
            close('.title');
            return false;
        }
        if($('.title').val().length > 30){
            show('提示', '标题长度不得超过30个字符', 'jinggao.png');
            close('.title');
            return false;
        }
        return true;
    });
});

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
    $('.tip_delete').css({'background':'url("images/'+pic+'") no-repeat 49% 25%'});
}
