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

    //查询是否存在此版块信息
    $sql_sel = "select * from ws_father_module where id={$_GET['id']}";
    $result_sel = execute($link, $sql_sel);
    $data = fetch_array($result_sel);
    if (mysqli_num_rows($result_sel) == 0) {
        skip('index.php', 'error', '这个父版块信息不存在！');
        exit();
    }
    
    /*查询出传过来的id对应的所有子版块*/
    $sql_son = "select * from ws_son_module where father_module_id={$_GET['id']}"; 
    $result_son = execute($link, $sql_son);
    $id_son = ''; //所有子版块的id
    $list_son = ''; //所有子版块的名称
    while (@$data_son = mysqli_fetch_assoc($result_son)) { //将查询出来的所有的子版块id连接在一起
        $id_son .= $data_son['id'].',';
        $list_son .= "<a href='list_son.php?id={$data_son['id']}'>{$data_son['module_name']}</a> ";
    }
    $id_son = trim($id_son, ','); //去掉子版块号前后的逗号
    if ($id_son == '') {
        $id_son = -1;
    }
    //查询所有子版块对应的帖子
    $sql_total = "select * from ws_content where module_id in({$id_son})"; 
    $result_total = execute($link, $sql_total);
    $data_total = mysqli_num_rows($result_total);
    
    //查询今天发的帖子总数
    $sql_total_today = "select * from ws_content where module_id in({$id_son}) and time>CURDATE()";
    $result_total_today = execute($link, $sql_total_today);
    $total_today = mysqli_num_rows($result_total_today);
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/public.css">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/list.css">
<title><?php echo $data['module_name']?> - <?php echo $data_info['index_title']?></title>
</head>
<body>
<?php require_once 'inc/header.inc.php';?>
<div style="margin-top:55px;"></div>
<div id="position" class="auto">
	 <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data['id']?>"><?php echo $data['module_name']?></a>
</div>
<div id="main" class="auto">
	<div id="left">
		<div class="box_wrap">
			<h3><?php echo $data['module_name']?></h3>
			<div class="num">
			    今日：<span><?php echo $total_today?></span>&nbsp;&nbsp;&nbsp;
			    总帖：<span><?php echo $data_total?></span>
			  <div class="moderator"> 子版块：<?php echo $list_son;?></div>
			</div>
			<div class="pages_wrap">
				<a class="btn publish" href="publish.php?father_module_id=<?php echo $_GET['id']; ?>"></a>
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
			wc.title,wc.id,wc.time,wc.times,wc.module_id,wc.member_id,wm.user,wm.photo,wsm.module_name from ws_content wc,ws_member wm,ws_son_module wsm where 
			wc.module_id in({$id_son}) and 
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
					<div class="titleWrap">
						<a href="list_son.php?id=<?php echo $data_content['module_id']?>">[<?php echo $data_content['module_name']?>]
						</a>&nbsp;
						<h2>
							<a href="show.php?cid=<?php echo $data_content['id'];?>">
								<?php echo $data_content['title']?>
							</a>
						</h2>
					</div>
					<p>
						楼主：<?php echo $data_content['user']?> 发布时间：<?php echo $data_content['time']?> 最后回复：<?php echo $last_time?>
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
		<div class="pages_wrap">
			<a class="btn publish" href="publish.php?father_module_id=<?php echo $_GET['id']; ?>"></a>
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