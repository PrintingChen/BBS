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

	if(!$member_id=login_state($link)){
		skip('login.php', 'error', '请登录之后再对自己的头像做设置!');
		exit();
	}

	$query="select * from ws_member where id={$member_id}";
	$result_memebr=execute($link,$query);
	$data_member=mysqli_fetch_assoc($result_memebr);
	if(isset($_POST['submit'])){
		$save_path='uploads'.date('/Y/m/d/');//写上服务器上文件系统的路径，而不是url地址
		$upload=upload($save_path,'8M','photo');
		if($upload['return']){
			$query="update ws_member set photo='{$upload['save_path']}' where id={$member_id}";
			execute($link, $query);
			if(mysqli_affected_rows($link)==1){
				skip("member.php?mid={$member_id}",'ok','头像设置成功！');
				exit();
			}else{
				skip('member_photo_update.php','error','头像设置失败，请重试');
				exit();
			}
		}else{
			skip('member_photo_update.php', 'error',$upload['error']);
			exit();
		}
	}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>头像修改 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/member_photo_update.css">

</head>
<body>
	<div id="main">
		<h2>更改头像</h2>
		<div class="pic">
			<h3>原头像：</h3>
			<img width="180" height="180" src="<?php if($data_member['photo']!=''){echo SUB_URL.$data_member['photo'];}else{echo 'images/photo.jpg';}?>" />
			<br />
			最佳图片尺寸：180*180
		</div>
		<div class="button"  style="margin-top:15px;">
			<form method="post" enctype="multipart/form-data">
				<input style="cursor:pointer;" width="100" type="file" name="photo" /><br /><br />
				<input class="submit" type="submit" name="submit" value="更改" />
			</form>
		</div>
	</div>
</body>
</html>