<?php
    session_start();
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';	
	
	$link = connect();

    //管理员是否登录
    if (manage_login_state($link)) {
        skip_manage('index.php', 'error', '请不要重复登录！');
        exit();
    }

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);

    if (isset($_POST['submit'])) {
    	include 'inc/login.func.php';
    	$clean = array();
    	$clean['name'] = $_POST['name'];
    	$clean['psw'] = md5($_POST['psw']);
    	$clean['vcode'] = check_code($_SESSION['code'], $_POST['vcode']);

    	$sql = "select * from ws_manage where name='{$clean['name']}' and psw='{$clean['psw']}'";
    	$result = execute($link, $sql);

    	if (mysqli_num_rows($result) == 1) {
            $data = fetch_array($result);
            $_SESSION['manage']['name'] = $data['name'];
            $_SESSION['manage']['psw'] = $data['psw'];
            $_SESSION['manage']['id'] = $data['id'];
            $_SESSION['manage']['level'] = $data['level'];
            skip_manage('index.php', 'ok', '恭喜你，登录成功！');
            exit();
    	}else{
    		skip('login.php', 'error', '管理员名称或密码错误！');
            exit();
    	}


    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
	<div id="main">
		<div class="t1">体育吧</div>
		<div class="title">后台管理登录</div>
		<form method="post">
			<label>用户名：<input class="text" type="text" name="name" /></label>
			<label>密　码：<input class="text" type="password" name="psw" /></label>
			<label>验证码：<input class="text" type="text" name="vcode" /></label>
			<label><img class="vcode" src="../inc/vcode.php" alt="验证码" title="点击刷新验证码" /></label>
			<label><input class="submit" type="submit" name="submit" value="登录" /></label>
		</form>
	</div>
</body>
</html>