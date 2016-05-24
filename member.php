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

    //判断是否处于登录的状态
	$member_id = login_state($link); 
		
    /*判断mid*/
    if (!isset($_GET['mid']) || !is_numeric($_GET['mid'])){
        skip('index.php', 'error', '会员id参数错误！');
        exit();
    };

    /*查询是否存在mid对应的会员信息*/
    $sql_member = "select * from ws_member where id={$_GET['mid']}";
    $result_member = execute($link, $sql_member);
    $data_member = fetch_array($result_member);
    if (mysqli_num_rows($result_member) == 0) {
        skip('index.php', 'error', '不存在此会员信息！');
        exit();
    }

    /*帖子总数*/
    $sql_count = "select * from ws_content where member_id={$_GET['mid']}";
    $result_count = execute($link, $sql_count);
    $count = mysqli_num_rows($result_count);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data_member['user']?>个人中心 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/member.css">
	<link rel="stylesheet" href="style/list.css">
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
	<script type="text/javascript" src="js/member.js"></script>
</head>
<body>
	<?php require_once 'inc/header.inc.php';?>
	<div style="margin-top:55px;"></div>
	<div id="position" class="auto">
		<a href="index.php">首页</a> &gt; <?php echo $data_member['user']?>个人中心
	</div>
	<div id="main" class="auto">
		<div id="left">
			<ul class="postsList">
			<?php 
				$page = page($count, 5);
				$sql_content = "select wc.title,wc.id,wc.time,wc.times,wc.module_id,wc.member_id,wm.user,wm.photo from ws_content wc,ws_member wm where wc.member_id={$_GET['mid']} and wc.member_id=wm.id order by id desc {$page['limit']}";
				$result_content = execute($link, $sql_content);
				while($data_content = fetch_array($result_content)){
					$data_content['title'] = htmlspecialchars($data_content['title']);

					//最后回复时间
					$sql = "select time from ws_reply where content_id={$data_content['id']} order by id desc limit 1";
				    $last_reply_time = execute($link, $sql);
				    if (nums($link, $sql) == 0) {
				    	$last_time = '暂无回复';
				    }else {
				    	$result_reply_time = fetch_array($last_reply_time);		    		
				    	$last_time = $result_reply_time['time'];
				    }


					//回复次数
				    $sql_reply = "select * from ws_reply where content_id={$data_content['id']}";
				    $result_reply = execute($link, $sql_reply);
				    $count_reply = mysqli_num_rows($result_reply);
					 
			?>
				<li>
					<div class="smallPic">
						<a href="javascript:void(0);">
							<img title="<?php echo $data_content['user']?>" width="45" height="45" src="<?php if($data_content['photo'] != ''){echo $data_content['photo'];}else{echo 'images/2374101_small.jpg';}?>" />
						</a>
					</div>
					<div class="subject">
						<div class="titleWrap"><h2><a href="show.php?cid=<?php echo $data_content['id']?>"><?php echo $data_content['title']?></a></h2></div>
						<p class="current">
						<?php
							if ($member_id == $data_content['member_id']) {
								$html = <<<EOT
									<a style='color:#999;' href="content_update.php?cid={$data_content['id']}">编辑</a> | 
									<a style="color:#f00;" href="javascript:tip({$data_content['id']})";>删除</a>&nbsp;
EOT;
								echo $html;
							}
						?>
							发帖时间：<?php echo $data_content['time']?>&nbsp;
							最后回复：<?php echo $last_time?>
						</p>
					</div>
					<div class="count">
						<p>
						回复<br /><span><?php echo $count_reply ?></span>
					</p>
					<p>
						浏览<br /><span><?php echo $data_content['times']?></span>
					</p>
					</div>
					<div style="clear:both;"></div>
				</li>
			<?php }?>
			</ul>
			<div class="pages" style="margin-top: 10px;">
				<?php
					echo $page['html'];
				?>

			</div>
		</div>
		<div id="right">
			<div class="member_big">
				<dl>
					<dt>
						<img width="180" height="180" src="<?php if($data_member['photo'] != ''){echo $data_member['photo'];}else{echo 'images/photo.jpg';}?>" />
					</dt>
					<dd class="name"><?php echo $data_member['user']?></dd>
					<dd style="text-align:center;padding-bottom:5px;color:#999;">帖子总数：<?php echo $count?></dd>
					<?php
					if ($member_id == $data_member['id']) {
						echo "<dd class='photo' style='text-align:center;padding-bottom:5px;color:#999;'>操作：<a style='color:#f00;' target='_blank' href='member_photo_update.php'>修改头像</a></dd>";
					}
					?>
					
				</dl>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php require_once 'inc/footer.inc.php';?>
<!-- 弹框开始 -->
<?php prompt('确定要删除吗？')?>
<!-- 弹框结束-->
</body>
</html>