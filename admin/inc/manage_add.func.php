<?php
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }	
    
    /**
     * check_name() 检测用户名
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_name($link, $data){
       //去掉前后的空格
       $data = trim($data);
       //长度验证
       if ( empty($data) || mb_strlen($data) > 20 ) {
           skip('manage_add.php', 'error', '管理员名称不得为空或大于20个字符！');
           exit();
       }
       //限制敏感字符
       $pattern = '/[<>\'\"\ \	]/';
       if ( preg_match($pattern, $data) ) {
           skip('manage_add.php', 'error', '管理员名称不能包含敏感字符!');
           exit();
       }
       return escape($link, $data);
    }

 	/**
     * check_pwd() 检测密码
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_psw($link, $data){
        //密码长度不得小于6位或大于20位
        if ( mb_strlen($data) < 6 || mb_strlen($data) > 20 ) {
            skip('manage_add.php', 'error', '密码长度不得小于6位或大于20位！');
            exit();
        }
        //密码必须是字母，数字或者下划线的组合
        $pattern1 = '/^\w+$/';
        if(!preg_match($pattern1, $data)){
            skip('manage_add.php', 'error', '密码必须是字母，数字或者下划线！');
            exit();
        }
        return escape($link, md5($data));
    }
    
    /**
	 *check_level() 检测管理员等级
	 *
	 *
     */
    function check_level($link, $level){
    	if (!isset($level)) {
    		$level = 0;
    	}elseif ($level == '0') {
    		$level = 0;
    	}elseif ($level == '1') {
    		$level = 1;
    	}else {
    		$level = 0;
    	}

    	return escape($link, $level);
    }

?>