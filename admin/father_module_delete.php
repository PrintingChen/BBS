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
        skip('father_module.php', 'error', 'id传参错误！');
        exit();
    }
    
    $sql_sel = "select * from ws_son_module where father_module_id={$_GET['id']}";
    if (nums($link, $sql_sel)) { //判断此父版块之下是否有子版块，如果有则要先将子版块删除之后，方可删除此父版块
        skip('father_module.php', 'error', '删除失败，这个版块下有子版块，请先将子版块删除！');
	    exit();
    }
    
    $sql = "delete from ws_father_module where id={$_GET['id']}";
    execute($link, $sql);
	if (mysqli_affected_rows($link)) {
	    skip('father_module.php', 'ok', '删除成功！');
	    exit();
	}else {
	    skip('father_module.php', 'error', '删除失败！');
	    exit();
	}
	





?>