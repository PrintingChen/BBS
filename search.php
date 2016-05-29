<?php
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    $link = connect();

    //判断是否处于登录的状态
    $member_id = login_state($link); 

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

    if (!isset($_GET['keywords'])) {
    	$_GET['keywords'] = '';
    }

    $_GET['keywords'] = escape($link, $_GET['keywords']);

    $_GET['keywords'] = trim($_GET['keywords']);

    $nowTime = microtime(true);
    //搜索到的记录总数
    $sql = "select * from ws_content where title like '%{$_GET['keywords']}%'";
    $result = execute($link, $sql);
    $data_total = mysqli_num_rows($result);
    $endTime = microtime(true) - $nowTime;

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>搜索 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/list.css">
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<?php require_once 'inc/header.inc.php';?>	
	<div style="margin-top:55px;"></div>
	<div id="main" class="auto">
		<div id="left">
			<h3 style="color:#666;font-size: 16px;">共搜索到<span style="color:#f00;font-size:24px;"><?php echo $data_total?></span>条记录,用时<?php echo round($endTime, 5);?>秒</h3>
			<?php $data = page($data_total, 10);?>
			<div style="clear:both;"></div>
			<ul class="postsList">
			<?php
				$sql_content = "select 
					wc.title,wc.id,wc.time,wc.member_id,wc.times,wm.user,wm.photo,wsm.module_name 
					from ws_content wc,ws_member wm,ws_son_module wsm where 
					wc.title like '%{$_GET['keywords']}%' and 
					wc.member_id=wm.id and 
					wc.module_id=wsm.id {$data['limit']}";
					$result_content = execute($link, $sql_content);
					while (@$data_content = fetch_array($result_content)){
						$data_content['title'] = htmlspecialchars($data_content['title']);
						$data_content['title'] = str_replace($_GET['keywords'], "<span style='color:#f00;font-weight:bold;'>{$_GET['keywords']}</span>", $data_content['title']);
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
						<div class="titleWrap">&nbsp;&nbsp;<h2><a href="show.php?cid=<?php echo $data_content['id'];?>"><?php echo $data_content['title']?></a></h2></div>
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
				<div class="pages">
					<?php 
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