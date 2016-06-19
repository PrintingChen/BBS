<?php
    //定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect(); /*数据库连接*/

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

    //判断登录状态
	if(!$member_id=login_state($link)){
		skip('login.php', 'error', '请登录之后才能进行密码修改!');
		exit();
	}

	if (isset($_POST['submit'])) {
		$sql = "select * from ws_member where id={$member_id}";
		$result = execute($link, $sql);
		$data = fetch_array($result);
		$opsw = md5($_POST['opsw']);
		$npsw = md5($_POST['npsw']);

		//判断旧密码是否正确
		if ($opsw != $data['pwd']) {
			skip('member_psw_update.php', 'error', '旧密码错误，请重试!');
			exit();
		}
		//旧密码和新密码不能一致
		if ($npsw == $data['pwd']) {
			skip('member_psw_update.php', 'error', '旧密码不能和新密码一致，请重试!');
			exit();
		}

		//密码修改
		$sql_update = "update ws_member set pwd='{$npsw}' where id={$member_id}";
		$result_update = execute($link, $sql_update);
		if (mysqli_affected_rows($link)) {
			//密码修改成功后将原来登录的信息cookie删除掉
			setcookie('ws[user]', '', time()-36000);
			setcookie('ws[pwd]', '', time()-36000);
			skip('login.php', 'ok', '您的密码已修改，请重新登录!');
			exit();
		}else{
			skip('member_psw_update.php', 'error', '密码修改失败!');
			exit();
		}

	}



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改密码 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/member_psw_update.css">
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/confirm.js"></script>
	<script type="text/javascript" src="js/member_psw_update.js"></script>
</head>
<body>
	<?php require_once 'inc/header.inc.php';?>
	<div style="margin-top:55px;"></div>
	<div id="position" class="auto">
		<a href="index.php">首页</a> &gt; 密码修改
	</div>
	<div class="auto main">
		<div class="form-main">
			<form method="POST">
				<div class="basic-info"><span>旧密码：</span><input class="basic-input" type="password" name="opsw"></div>
				<div class="basic-info"><span>新密码：</span><input class="basic-input npsw" type="password" name="npsw" placeholder="密码长度不得少于6位或超过20位"></div>
				<div class="basic-info"><span>确认密码：</span><input class="basic-input nqpsw" type="password" name="nqpsw" placeholder="必须与新密码一致"></div>
				<div class="basic-info"><input class="btn" type="submit" name="submit" value="确认修改"></div>
			</form>
		</div>
	</div>
	<?php require_once 'inc/footer.inc.php';?>
<!-- 弹框开始 -->
<div id="tip_win">
    <p class="tip_win_title">
        <span>删除提示</span>
        <a class="close" href="javascript:;"></a>
    </p>
    <div class="tip_delete"></div>
    <p class="tip_win_btn">
        <a id="delete_ok" class="tip_btn" href="javascript:void;">确定</a>
    </p>
</div>
<div id="cover"></div>
<!-- 弹框结束-->
</body>
</html>