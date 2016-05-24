<?php 
    session_start();
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    $link = connect();

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

    //判断当前是否为登录状态
    if (login_state($link)){
        skip('index.php', 'error', '您已经处于登录状态，无法进行此操作！');
        exit();
    }
    if (isset($_POST['submit'])){
        include 'inc/login_func.php'; //引入验证文件
        $clean = array();
        $clean['user'] = check_user($link, $_POST['user']);
        $clean['pwd'] = check_pwd($link, $_POST['pwd']);
        check_code($_POST['vcode'], $_SESSION['code']); //判断验证码,防止恶意注册
        $clean['time'] = $_POST['time'];
        
        $sql_sel = "select * from ws_member where user='{$clean['user']}' and pwd='{$clean['pwd']}'";
        if (nums($link, $sql_sel) == 1) {
            setcookie('ws[user]', $clean['user'], time()+$clean['time']);
            setcookie('ws[pwd]', $clean['pwd'], time()+$clean['time']);
            //登录时间的更新
            $time = Date('Y-m-d H:i:s', time());
            $sql = "update ws_member set last_time='{$time}' where user='{$clean['user']}'";
            execute($link, $sql);
            skip('index.php', 'ok', '恭喜你，登录成功！');
            exit();
        }else {
            skip('login.php', 'error', '用户名或密码错误！');
            exit();
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/public.css">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/register.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
<title>登录 - <?php echo $data_info['index_title']?></title>
</head>
<body>
<?php require_once 'inc/header.inc.php';?>
<div style="margin-top: 55px;"></div>
<div id="register" class="auto">
	<h2>登录是一种状态</h2>
	<form method="post">
		<label>用户名：<input class="user" type="text" name="user" placeholder="请输入用户名"  /><span></span></label>
		<label>密码：<input class="pwd" type="password" name="pwd" placeholder="请输入密码"  /><span></span></label>
		<label>验证码：<input class="vcode" name="vcode" type="text" placeholder="请输入验证码" /><span>*请输入下方验证码</span></label>
		<img class="vcode" src="inc/vcode.php" alt="验证码" title="点击刷新验证码" />
		<label style="margin: 30px 165px 0 0;">自动登录：
			<select style="width:240px;height:25px;" name="time">
				<option value="3600">1小时内</option>
				<option value="86400">1天内</option>
				<option value="259200">3天内</option>
				<option value="2592000">30天内</option>
			</select>
			<span>*公共电脑上请勿长期自动登录</span>
		</label>
		<div style="clear:both;"></div>
		<input style="margin-left:245px;" class="btn" type="submit" name="submit" value="登录" />
	</form>
</div>
<?php require_once 'inc/footer.inc.php';?>
</body>
</html>