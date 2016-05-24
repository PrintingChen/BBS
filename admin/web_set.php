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
    	$_POST = escape($link, $_POST);
    	$sql = "update ws_info set index_title='{$_POST['index_title']}',keywords='{$_POST['keywords']}',description='{$_POST['description']}' where id=1";
    	$result = execute($link, $sql);
    	if(mysqli_affected_rows($link)==1){
			skip("web_set.php",'ok','设置成功！');
			exit();
		}else{
			skip('web_set.php','error','设置失败！');
			exit();
		}
    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="Keywords" content="<?php echo $data_info['keywords']?>">
  	<meta name="Description" content="<?php echo $data_info['description']?>">
	<title>系统设置 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/main.css">
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<div id="main">
<p class="titile">当前位置：系统设置</p>
<form method="post">
	<table class="au">
		<tr>
			<td>网站标题</td>
			<td><input name="index_title" type="text" value="<?php echo $data_info['index_title']?>" /></td>
			<td>
				网站页面的标题
			</td>
		</tr>
		<tr>
			<td>关键字</td>
			<td><input name="keywords" type="text" value="<?php echo $data_info['keywords']?>" /></td>
			<td>
				关键字
			</td>
		</tr>
		<tr>
			<td>网站描述</td>
			<td>
				<textarea name="description" style="width:410px;height:160px;"><?php echo $data_info['description']?></textarea>
			</td>
			<td>
				描述
			</td>
		</tr>
	</table>
	<input style="margin-top:20px;cursor:pointer;" class="btn" type="submit" name="submit" value="设置" />
</form>
</div>
</body>
</html>