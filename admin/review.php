<?php
	session_start();
	//定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect(); //数据库连接

	//管理员是否登录
	if (!manage_login_state($link)) {
		skip_manage('login.php', 'error', '您还未登录！');
		exit();
	}

	/*判断cid的合法性*/
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip("post_manage.php", 'error', '帖子id传参错误！');
        exit();
    };

    //查询是否存在要审核的帖子信息
    $sql_content = "select * from ws_content where id={$_GET['cid']}";
    $result_content = execute($link, $sql_content);

    if (mysqli_num_rows($result_content) == 1) {
    	$data_content = fetch_array($result_content);
		$sql = "update ws_content set state=1 where id={$_GET['cid']}";
		execute($link, $sql);
		if (mysqli_affected_rows($link)) {
			skip("post_manage.php", 'ok', '恭喜你，帖子审核通过！');
			exit();
		}else {
			skip('post_manage.php', 'error', '这个帖子已经审核通过了，无需再审核！');
			exit();
		}
    }else {
    	skip('post_manage.php', 'error', '您要审核的帖子不存在！');
        exit();
    }

?>