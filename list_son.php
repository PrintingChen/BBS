<?php
    //定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    $link = connect(); //数据库连接

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

	//判断是否处于登录的状态
	$member_id = login_state($link); 

    /*判断id*/
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
        skip('index.php', 'error', 'id传参错误！');
        exit();
    };

    //查询传过来的id对应是否存在此子版块信息
    $sql_sel = "select * from ws_son_module where id={$_GET['id']}";
    $result_sel = execute($link, $sql_sel);
    $data_son = fetch_array($result_sel);
    $data_son['module_name'] = htmlspecialchars($data_son['module_name']);
    if (mysqli_num_rows($result_sel) == 0) {
        skip('index.php', 'error', '这个子版块信息不存在！');
        exit();
    }

    //传过来子版块的id对应的父版块信息
    $sql_father = "select * from ws_father_module where id={$data_son['father_module_id']}";
    $result_father = execute($link, $sql_father);
    $data_father = fetch_array($result_father);

    //查询除传过来的id对应子版块的总帖数
    $sql_total = "select * from ws_content where module_id={$_GET['id']}";
    $result_total = execute($link, $sql_total);
    $data_total = mysqli_num_rows($result_total);

    //查询今天发的帖子总数
    $sql_total_today = "select * from ws_content where module_id={$_GET['id']} and time>CURDATE()";
    $result_total_today = execute($link, $sql_total_today);
    $total_today = mysqli_num_rows($result_total_today);    

    //会员表信息
    $sql_member = "select * from ws_member where id={$data_son['member_id']}";
    $result_member = execute($link, $sql_member);
    $data_member = fetch_array($result_member);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data_son['module_name'];?> - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/list.css">
</head>
<body>
	<?php require_once 'inc/header.inc.php';?>
	<div style="margin-top:55px;"></div>
	<div id="position" class="auto">
		 <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data_son['father_module_id'];?>"><?php echo $data_father['module_name'];?></a> &gt; <?php echo $data_son['module_name'];?>
	</div>
	<div id="main" class="auto">
		<div id="left">
			<div class="box_wrap">
				<h3><?php echo $data_son['module_name'];?></h3>
				<div class="num">
				    今日：<span><?php echo $total_today; ?></span>&nbsp;&nbsp;&nbsp;
				    总帖：<span><?php echo $data_total; ?></span>
				</div>
				<div class="moderator">版主：
					<span>
						<?php 
							if (mysqli_num_rows($result_member) == 0) {
								echo "暂无版主";
							}else{
								echo $data_member['user'];
							}
							
						?>
					</span>
				</div>
				<div class="notice">简介：<?php echo $data_son['info']; ?></div>
				<div class="pages_wrap">
					<a class="btn publish" href="publish.php?son_module_id=<?php echo $_GET['id']; ?>"></a>
					<div class="pages">
				            <?php 
				               $data = page($data_total, 5);
				            ?>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<ul class="postsList">
			<?php
				$sql_content = "select 
					wc.title,wc.id,wc.time,wc.member_id,wc.times,wm.user,wm.photo,wsm.module_name 
					from ws_content wc,ws_member wm,ws_son_module wsm where 
					wc.module_id={$_GET['id']} and 
					wc.member_id=wm.id and 
					wc.module_id=wsm.id {$data['limit']}";
					$result_content = execute($link, $sql_content);
					while (@$data_content = fetch_array($result_content)){
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
						<a href="member.php?mid=<?php echo $data_content['member_id']?>">
							<img title="<?php echo $data_content['user']?>" width="45" height="45" src="<?php if($data_content['photo'] != ''){echo SUB_URL.$data_content['photo'];}else{echo 'images/2374101_small.jpg';}?>">
						</a>
					</div>
					<div class="subject">
						<div class="titleWrap">&nbsp;&nbsp;<h2><a href="show.php?cid=<?php echo $data_content['id'];?>" title="<?php echo $data_content['title']?>"><?php echo $data_content['title']?></a></h2></div>
						<p>
							楼主：<?php echo $data_content['user']?> 发布时间：<?php echo $data_content['time']?> 最后回复：<?php echo $last_time;?>
						</p>
					</div>
					<div class="count">
						<p>
							回复<br /><span><?php echo $count_reply;?></span>
						</p>
						<p>
							浏览<br /><span><?php echo $data_content['times'];?></span>
						</p>
					</div>
					<div style="clear:both;"></div>
				</li>
			<?php }?>
			</ul>
			<div class="pages_wrap">
				<a class="btn publish" href="publish.php?son_module_id=<?php echo $_GET['id']; ?>"></a>
				<div class="pages">
					<?php 
		               $data = page($data_total, 5);
		               echo $data['html'];
		            ?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div id="right">
			<div class="classList">
				<div class="title">版块列表</div>
				<ul class="listWrap">
				<?php 
				$query = "select * from ws_father_module";
				$result_father = execute($link, $query);
				while (@$data_father = fetch_array($result_father)){
				   
				?>
					<li>
						<h2><a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a></h2>
						<ul>
						<?php 
						$query = "select * from ws_son_module where father_module_id={$data_father['id']}";
						$result_son = execute($link, $query);
						while (@$data_son = fetch_array($result_son)) {
						?>
							<li><h3><a href="list_son.php?id=<?php echo $data_son['id'];?>"><?php echo $data_son['module_name']?></a></h3></li>
						<?php }?>
						</ul>
					</li>
				<?php }?>	
				</ul>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php require_once 'inc/footer.inc.php';?>
</body>
</html>