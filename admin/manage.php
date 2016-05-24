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
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

    //管理员信息
    $sql = 'select * from ws_manage';
    $result = execute($link, $sql);

    

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员列表 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="js/manage.js"></script>
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main" style="height: 600px">
	<p class="titile">当前位置：管理员列表</p>
	<table class="list">
		<tr>
			<th>管理员名称</th>
			<th>等级</th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
<?php while (@$data = fetch_array($result)) {
		if ($data['level']) {
			$level = '超级管理员';
		}else{
			$level = '普通管理员';
		}
		echo "<tr>";
			echo "<td>{$data['name']}[id:{$data['id']}]</td>";
			echo "<td>{$level}</td>";
			echo "<td>{$data['create_time']}</td>";
			echo "<td>
					<a href='manage_update.php?id={$data['id']}'>[修改]</a>
					<a class='delete' href='javascript:tip({$data['id']});' id='{$data['id']}'>[删除]</a>
				 </td>";
		echo "</tr>";

      }
?>
	</table>
</div>
<!--主面板结束-->
<!-- 弹框开始 -->
<?php prompt('确定要删除吗？')?>
<!-- 弹框结束-->
</body>
</html>