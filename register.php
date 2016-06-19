<?php
    session_start(); 
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';

    $link = connect();

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);

    //判断当前是否为登录状态
    if (login_state($link)){
        skip('index.php', 'error', '您已经登录，无法进行此操作！');
        exit();
    }
    
    if (isset($_POST['submit'])) {
       //判断验证码,防止恶意注册
       check_vcode($_POST['vcode'], $_SESSION['code']);
	   include 'inc/register.func.php'; //引入验证文件
	   $clean = array();
	   $clean['user'] = check_user($link, $_POST['user']);
	   $clean['pwd'] = check_pwd($link, $_POST['pwd']);
	   $clean['email'] = check_email($link, $_POST['email']);
	   $clean['qq'] = check_qq($_POST['qq']);
	   
	   //添加数据之前先判断是否已被注册
	   $sql_sel = "select * from ws_member where user='{$clean['user']}'";
	   if (nums($link, $sql_sel)) {
	       skip('register.php', 'error', '很抱歉，该用户名已被注册！');
	       exit();
	   }
	   
	   //数据添加
	   $sql_ins = "insert into ws_member(user,pwd,sex,email,qq,register_time,last_time) values('{$clean['user']}','{$clean['pwd']}','{$_POST['sex']}','{$clean['email']}',{$clean['qq']},NOW(),NOW())";
	   $result = execute($link, $sql_ins);
       
	   //判断数据是否添加成功
	   if (mysqli_affected_rows($link) == 1) {
	       setcookie('ws[user]', $clean['user']);
	       setcookie('ws[pwd]', $clean['pwd']);
	       skip('index.php', 'ok', '恭喜你，注册成功！');
	       exit();
	   }else {
	       skip('register.php', 'error', '很抱歉，注册失败！');
	       exit();
	   }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>注册 - <?php echo $data_info['index_title']?></title>
<link rel="stylesheet" href="style/public.css">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/register.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php require_once 'inc/header.inc.php';?>
<div style="margin-top: 55px;"></div>
<div id="register" class="auto">
    <h2>欢迎注册会员</h2>
	<form method="post">
    	<label>用户名：<input class="user" type="text" name="user" placeholder="请输入用户名" /><span>*用户名不得为空，并且长度不得超过20个字符</span></label>
    	<label>密码：<input class="pwd" type="password" name="pwd" placeholder="请输入密码（数字，字母或下划线的组合）" /><span>*密码长度不得少于6位或超过20位</span></label>
    	<label>确认密码：<input class="confirm_pwd" type="password" name="confirm_pwd" placeholder="请重新输入一次密码" /><span>*必须与原密码一致</span></label>
    	<label class="sex_on">性别：<input checked="checked" class="sex" type="radio" name="sex" value="男"/>男 <input class="sex" type="radio" name="sex" value="女"/>女</label>
    	<label>邮箱：<input class="email" type="text" name="email" placeholder="请输入邮箱" /><span>*不能为空</span></label>
    	<label>QQ：<input class="qq" type="text" name="qq" placeholder="请输入QQ" /><span>*不能为空</span></label>
    	<label>验证码：<input class="vcode" name="vcode" type="text" placeholder="请输入验证码" /><span>*不能为空</span></label>
    	<img class="vcode" src="inc/vcode.php" alt="验证码" title="点击刷验证码" />
    	<div style="clear:both;"></div>
    	<input style="margin-left:245px;" class="btn" type="submit" name="submit" value="注册" />
    </form>
</div>
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
    <?php require_once 'inc/footer.inc.php';?>
</body>
</html>