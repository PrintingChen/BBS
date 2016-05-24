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
    
    if (!isset($_GET['id']) || !is_numeric($_GET['id']) ) {
        skip('son_module.php', 'error', 'id传参错误！');
        exit();
    }
    
    $sql = "delete from ws_son_module where id={$_GET['id']}";
    execute($link, $sql);
	if (mysqli_affected_rows($link)) {
	    skip('son_module.php', 'ok', '恭喜你，删除成功！');
	    exit();
	}else {
	    skip('son_module.php', 'error', '很抱歉，删除失败！');
	    exit();
	}
	





?>