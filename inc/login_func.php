<?php
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
    
    /**
     * check_user()
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_user($link, $data){
       //去掉前后的空格
       $data = trim($data);
       //用户名不得为空或大于20个字符
       if ( empty($data) || mb_strlen($data) > 20 ) {
           skip('login.php', 'error', '用户名不得为空或大于20个字符！');
           exit();
       }
       
       return escape($link, $data);
    }
    
    /**
     * check_pwd()
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_pwd($link, $data){
        //密码长度不得小于6位或大于20位
        if ( mb_strlen($data) < 6 || mb_strlen($data) > 20 ) {
            skip('login.php', 'error', '密码长度不得小于6位或大于20位！');
            exit();
        }
        return escape($link, md5($data));
    }
    
    /**
     * check_vcode() 检测验证码
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
