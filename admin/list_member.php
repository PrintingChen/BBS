<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';
    $link = connect(); //数据库连接

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

	//管理员是否登录
    if (!manage_login_state($link)) {
        skip_manage('index.php', 'error', '请不要重复登录！');
        exit();
    }

    $sql_member = "select * from ws_member order by id asc";
    $result_member = execute($link, $sql_member); 


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户列表 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main" style="height: 600px">
	<p class="titile">当前位置：用户列表</p>
	<table class="list">
		<tr>
			<th>用户名称</th>
			<th>性别</th>
			<th>邮箱</th>
			<th>QQ</th>
			<th>注册时间</th>
			<th>最后登录时间</th>
		</tr>
<?php while (@$data = fetch_array($result_member)) {
		echo "<tr>";
			echo "<td>{$data['user']}[id:{$data['id']}]</td>";
			echo "<td>{$data['sex']}</td>";
			echo "<td>{$data['email']}</td>";
			echo "<td>{$data['qq']}</td>";
			echo "<td>{$data['register_time']}</td>";
			echo "<td>{$data['last_time']}</td>";
		echo "</tr>";

      }
?>
	</table>
</div>
<!--主面板结束-->
</body>
</html>