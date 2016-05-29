$(function(){
    var oForm = document.getElementsByTagName('form')[1];
    oForm.onsubmit = function(){
    	
    	/*验证密码*/
    	if(oForm.npsw.value.length < 6 || oForm.npsw.value.length > 20 ){
    		show('提示', '密码长度不得小于6位或大于20位', 'jinggao.png');
    		close('.npsw');
    		return false;
    	}
    	//密码必须是字母，数字或者下划线的组合
    	if(!(/^\w+$/g.test(oForm.npsw.value))){
    		show('提示', '密码必须包含字母，数字或者下划线', 'jinggao.png');
    		close('.npsw');
            
    		return false;
    	}
    	//密码不能全为数字
    	if(/^\d+$/.test(oForm.npsw.value)){
    		show('提示', '密码不能为全数字', 'jinggao.png');
    		close('.npsw');
    		return false;
    	}
    	//原密码和确认密码必须一致
    	if(oForm.npsw.value != oForm.nqpsw.value){
    		show('提示', '原密码和确认密码不一致', 'jinggao.png');
    		close('.nqpsw');
    		return false;
    	}
    	return true;
    };
    
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
