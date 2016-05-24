<?php
    session_start();
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

	$link = connect();

    //管理员是否登录
    if (!manage_login_state($link)) {
        skip_manage('login.php', 'error', '您还未登录！');
        exit();
    }

    session_unset(); //释放当前会话注册的所有会话变量
	session_destroy(); //销毁当前会话中的全部数据    
	setcookie(session_name(), '', time()-3600, '/'); //销毁保存在客户端的卡号

	skip('login.php', 'ok', '您已经注销了！');
	exit();

?>