$(function(){
    var oForm = document.getElementsByTagName('form')[1];
    oForm.onsubmit = function(){
        //验证用户名,用户名长度不得大于20个字符
    	if(oForm.user.value.length > 20 || oForm.user.value.length == 0){
    		show('提示', '用户名长度不得为空或大于20个字符', 'jinggao.png');
    		close('.user');
    		return false;
    	}
    	//用户名不得包含一些敏感的字符
    	if(/[<>\'\"\ \	\!\#\*\&\^\$\~\`\/\\\，\。\：\；]/i.test(oForm.user.value)){
    		show('提示', '用户名不得包含敏感字符', 'jinggao.png');
    		close('.user');
    		return false;
    	}
    	
    	/*验证密码*/
    	if(oForm.pwd.value.length < 6 || oForm.pwd.value.length > 20 ){
    		show('提示', '密码长度不得小于6位或大于20位', 'jinggao.png');
    		close('.pwd');
    		return false;
    	}
    	//密码必须是字母，数字或者下划线的组合
    	if(!(/^\w+$/g.test(oForm.pwd.value))){
    		show('提示', '密码必须包含字母，数字或者下划线', 'jinggao.png');
    		close('.pwd');
    		return false;
    	}
    	//密码不能全为数字
    	if(/^\d+$/.test(oForm.pwd.value)){
    		show('提示', '密码不能为全数字', 'jinggao.png');
    		close('.pwd');
    		return false;
    	}
    	//原密码和确认密码必须一致
    	if(oForm.pwd.value != oForm.confirm_pwd.value){
    		show('提示', '原密码和确认密码不一致', 'jinggao.png');
    		close('.confirm_pwd');
    		return false;
    	}
    	
    	/*邮箱验证*/
    	if(oForm.email.value.length == 0){
    		show('提示', '邮箱不能为空', 'jinggao.png');
    		close('.email');
    		return false;
    	}
    	if(!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(oForm.email.value)){
    		show('提示', '邮箱不合法', 'jinggao.png');
    		close('.email');
    		return false;
    	}
    	
    	/*qq验证*/
    	if(oForm.qq.value.length == 0){
    		show('提示', 'QQ不得为空', 'jinggao.png');
    		close('.qq');
    		return false;
    	}
    	if(!/^[1-9][0-9]{4,10}$/.test(oForm.qq.value)){
    		show('提示', 'QQ不合法，长度必须为5~11位', 'jinggao.png');
    		close('.qq');
    		return false;
    	}
    	
    	/*验证码验证*/
    	if(oForm.vcode.value.length != 4){
    		show('提示', '验证码长度必须为4位', 'jinggao.png');
    		close('.vcode');
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
