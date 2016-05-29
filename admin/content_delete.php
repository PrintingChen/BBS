<?php
    //定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect(); /*数据库连接*/

    //判断是否处于登录的状态
	if (!$member_id = login_state($link)) {
		skip('login.php', 'error', '您没有登录！');
        exit();
	}

    /*判断cid的合法性*/
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip("member.php?mid=$member_id", 'error', '会员id传参错误！');
        exit();
    };
    
    //查询是否存在要删除的帖子信息
    $sql_content = "select member_id from ws_content where id={$_GET['cid']}";
    $result_content = execute($link, $sql_content);

    if (mysqli_num_rows($result_content) == 1) {
    	$data_content = fetch_array($result_content);
    	if ($member_id == $data_content['member_id']) { //判断帖子楼主是否与操作者是同一个
    		$sql = "delete from ws_content where id={$_GET['cid']}";
    		execute($link, $sql);
    		if (mysqli_affected_rows($link)) {
    			skip("member.php?mid={$data_content['member_id']}", 'ok', '恭喜你，删除成功！');
        		exit();
    		}else {
    			skip('index.php', 'error', '对不起，删除失败！');
        		exit();
    		}
    	}else {
    		skip("member.php?mid={$data_content['member_id']}", 'error', '您没有权限删除！');
        	exit();
    	}
    }else {
    	skip('index.php', 'error', '要删除的帖子不存在！');
        exit();
    }


?>