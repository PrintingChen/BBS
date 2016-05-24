$(function(){
	$('form').submit(function(){

		if($('.manage_name').val().length == 0 || $('.manage_name').val().length < 0 || $('.manage_name').val().length > 20){
			show('警告', '管理员名称长度不得为空或大于20个字符！', 'jinggao.png');
			close('.manage_name');
			return false;
		}
		if (/[<>\'\"\ \	]/.test($('.manage_name').val())) {
			show('警告', '管理员名称不得包含明感字符！', 'jinggao.png');
			close('.manage_name');
			return false;
		}
		
		if ($('#psw').val().length < 6 || $('#psw').val().length > 20) {
			show('警告', '管理员密码必须大于6位或小于20位！', 'jinggao.png');
			close('#psw');
			return false;
		}

		if (!(/^\w+$/.test($('#psw').val()))) {
			show('警告', '密码必须是字母，数字或者下划线！', 'jinggao.png');
			close('#psw');
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