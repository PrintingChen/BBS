<?php
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }	
    
    /**
     * check_user() 检测用户名
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_user($link, $data){
       //去掉前后的空格
       $data = trim($data);
       //长度不得小于$_min_num位或大于$_max_num位
       if ( empty($data) || mb_strlen($data) > 20 ) {
           skip('register.php', 'error', '用户名不得为空或大于20个字符！');
           exit();
       }
       //限制敏感字符
       $pattern = '/[<>\'\"\ \	]/';
       if ( preg_match($pattern, $data) ) {
           skip('register.php', 'error', '用户名不能包含敏感字符!');
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
    function check_pwd($link, $data){
        //密码长度不得小于6位或大于20位
        if ( mb_strlen($data) < 6 || mb_strlen($data) > 20 ) {
            skip('register.php', 'error', '密码长度不得小于6位或大于20位！');
            exit();
        }
        //密码必须是字母，数字或者下划线的组合
        $pattern1 = '/^\w+$/';
        if(!preg_match($pattern1, $data)){
            skip('register.php', 'error', '密码必须是字母，数字或者下划线！');
            exit();
        }
        return escape($link, md5($data));
    }
    
    /**
     * check_email() 检测邮箱
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_email($link, $data){
        //邮箱不得为空
        if (empty($data)){
            skip('register.php', 'error', '邮箱不得为空！');
            exit();
        }
        
        $pattern = '/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/';
        if (!preg_match($pattern, $data)) {
            skip('register.php', 'error', '邮箱不合法！');
            exit();
        }
        return escape($link, $data); 
    }
    
    /**
     * check_qq() 检测qq
     * @param number $data
     * @return number $data
     */
    function check_qq($data){
        $pattern = '/^[1-9][0-9]{4,10}$/';
        if (!preg_match($pattern, $data)){
            skip('register.php', 'error', 'QQ不合法，长度必须为5~11位！');
            exit();
        }
        return $data;
    }

    
?>