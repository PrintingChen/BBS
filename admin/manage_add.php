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

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);

    if (isset($_POST['submit'])) {
        //引入验证文件
        include_once 'inc/manage_add.func.php';
        $clean = array();
        $clean['name'] = check_name($link, $_POST['name']);
        $clean['psw'] = check_psw($link, $_POST['psw']);
        $clean['level'] = check_level($link, $_POST['level']);
        
        //查询要插入的管理员是否已存在
        $sql = "select * from ws_manage where name='{$clean['name']}'";
        //$result = execute($link, $sql);
        if (nums($link, $sql) == 1) {
            skip('manage_add.php', 'error', '对不起，该管理员已经存在！');
            exit();
        }

        //插入数据
        $sql_ins = "insert into ws_manage(name,psw,create_time,level) values('{$clean['name']}', '{$clean['psw']}', now(), '{$clean['level']}')";
        execute($link, $sql_ins);
        if (mysqli_affected_rows($link)) {
            skip('manage.php', 'ok', '添加成功！');
            exit();
        }else {
            skip('manage_add.php', 'error', '添加失败！');
            exit();
        }

    }


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加管理员 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css"> 
	<link rel="stylesheet" href="style/main.css">
    <script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
    <script type="text/javascript" src="js/father_module_add.js"></script>
</head>
<body>
<?php include_once 'inc/header.inc.php';?>	
<!--主面板开始-->
<div id="main">
    <p class="titile">当前位置：添加管理员</p>
    <form action="manage_add.php" method="post">
        <table class="au">
    		<tr>
    			<td>管理员名称</td>
    			<td><input class="manage_name" id="a" name="name" type="text"></td>
    			<td>*名称不得为空或大于20个字符</td>
    		</tr>
    		<tr>
    			<td>管理员密码</td>
    			<td><input name="psw" id="psw" type="text"></td>
    			<td>*密码必须大于6位或小于20位</td>
    		</tr>
    		<tr>
    			<td>管理员等级</td>
    			<td>
					<select name="level">
						<option value="0">普通管理员</option>
						<option value="1">超级管理员</option>
					</select>
    			</td>
    			<td>*请选择一个等级</td>
    		</tr>
    	</table>
    	<input class="btn submit" type="submit" name="submit" value="添 加" />
	</form>
</div>
<!--主面板结束-->
<!-- 弹框开始 -->
<div id="tip_win">
    <p class="tip_win_title">
        <span>删除提示</span>
        <a class="close" href="javascript:;"></a>
    </p>
    <div class="tip_delete"></div>
    <p class="tip_win_btn">
        <a id="delete_ok" class="tip_btn" href="#">确定</a>
    </p>
</div>
<div id="cover"></div>
<!-- 弹框结束-->
</body>
</html>