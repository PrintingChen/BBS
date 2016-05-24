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
        skip('manage.php', 'error', '管理员id传参错误！');
        exit();
    }
    
    $sql_sel = "select * from ws_manage where id={$_GET['id']}";
    if (!nums($link, $sql_sel)) { //判断是否存在该管理员信息
        skip('manage.php', 'error', '对不起，您要删除的管理员信息不存在！');
	    exit();
    }
    
    $sql = "delete from ws_manage where id={$_GET['id']}";
    execute($link, $sql);
	if (mysqli_affected_rows($link)) {
	    skip('manage.php', 'ok', '删除成功！');
	    exit();
	}else {
	    skip('manage.php', 'error', '删除失败！');
	    exit();
	}
	





?>