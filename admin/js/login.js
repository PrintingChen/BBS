$(function(){
	code();
});


/**
 * code() 刷新验证码
 */
function code() {
    $('.vcode').click(function(){
       $(this).attr("src","../inc/vcode.php?tm="+Math.random()+"");
    });
}