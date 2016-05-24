$(function(){
	
	$('form').submit(function(){
		if($('.module_name').val().length == 0 || $('.module_name').val().length < 0 || $('.module_name').val().length > 50){
			show('警告', '版块名称长度不得为空或大于50个字符！', 'jinggao.png');
			close('.module_name');
			return false;
		}
		
		if (/[<>\'\"\ \	]/.test($('.module_name').val())) {
			show('警告', '版块名称不得包含明感字符！', 'jinggao.png');
			close('.module_name');
			return false;
		}
		
		if($('.info').val().length > 255){
			show('警告', '简介长度不得超过255个字符！', 'jinggao.png');
			close('.info');
			return false;
		}
		
		if (!$.isNumeric($('#sort').val())) {
			show('警告', '排序必须为数字！', 'jinggao.png');
			close('#sort');
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