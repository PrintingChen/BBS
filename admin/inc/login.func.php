<?php
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }	
    
   /**
     * check_code() 检测验证码
     * @param string $first_vcode
     * @param string $end_vcode
     * @return void
     */
    function check_code($first_vcode, $end_code) {
        if (strtolower($first_vcode) != strtolower($end_code)) {
            skip('login.php', 'error', '验证码错误！');
            exit();
        }
    }


?>