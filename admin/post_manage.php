<?php
	session_start();
	//定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect(); //数据库连接

	//页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result1 = execute($link, $sql_info);
    $data_info = fetch_array($result1);

	//管理员是否登录
	if (!manage_login_state($link)) {
		skip_manage('login.php', 'error', '您还未登录！');
		exit();
	}
	
	//分页函数
	$sql_total = "select * from ws_content";
	$result_total = execute($link, $sql_total);
	$data_total = mysqli_num_rows($result_total);
	$page = page($data_total,12);

	//帖子信息
	$sql_content = "select * from ws_content order by id asc {$page['limit']}";
	$result_content = execute($link, $sql_content);

?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <title>帖子管理 - <?php echo $data_info['index_title']?></title>
  <link rel="stylesheet" href="style/public.css">
  <link rel="stylesheet" href="style/index.css">
  <link rel="stylesheet" href="style/post_manage.css">
  <script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
  <script type="text/javascript" src="js/post_manage.js"></script>
 </head>
 <body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main" style="height: 600px">
	<p class="titile">当前位置：帖子管理</p>
	<table class="list">
		<tr>
			<th style='width:40px;'>帖子ID</th>
			<th>帖子标题</th>
			<th>帖子内容</th>
			<th style='width:150px;'>发布时间</th>
			<th style='padding-right:5px;'>发布者</th>
			<th style='width:80px;'>操作</th>
		</tr>
<?php while ($data_content = fetch_array($result_content)) {
		$sql_member = "select * from ws_member where id={$data_content['member_id']}";
		$result_member = execute($link, $sql_member);
		$data_member = fetch_array($result_member);
	
		echo "<tr>";
			echo "<td>{$data_content['id']}</td>";
			echo "<td>{$data_content['title']}</td>";
			echo "<td>{$data_content['content']}</td>";
			echo "<td>{$data_content['time']}</td>";
			echo "<td>{$data_member['user']}</td>";
			if($data_content['state']){
				echo "<td><a href='review.php?cid={$data_content['id']}' style='color:#009900;'>已通过</a><a class='delete' href='javascript:tip({$data_content['id']});'>删除</a></td>";
			}else{
				echo "<td><a href='review.php?cid={$data_content['id']}'>待审核</a><a class='delete' href='javascript:tip({$data_content['id']});'>删除</a></td>";
			}
		echo "</tr>";

      }
?>
	</table>
	<div class="pages_wrap">
		<div class="pages">
			<?php 
			   echo $page['html'];
			?>
		</div>
	</div>
</div>
<!--主面板结束-->	
<!-- 弹框开始 -->
<?php prompt('确定要删除吗？')?>
<!-- 弹框结束-->
 </body>
</html>
