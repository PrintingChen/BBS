<?php
    //定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    //数据库连接
    $link = connect();

	//页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);
    
    //判断是否处于登录的状态
	$member_id = login_state($link);

    /*判断id*/
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip('index.php', 'error', 'id传参错误！');
        exit();
    };
    
    //查询是否存在此帖子信息
    $sql_sel = "select * from ws_content where id={$_GET['cid']}";
    $result_sel = execute($link, $sql_sel);
    $data = fetch_array($result_sel);
    if (mysqli_num_rows($result_sel) == 0) {
        skip('index.php', 'error', '此帖子不存在！');
        exit();
    }

    //更新阅读的次数
    $sql_update = "update ws_content set times=times+1 where id={$_GET['cid']}";
    execute($link, $sql_update);

    /*$sql_content = "select * from ws_content wc,ws_son_module wsm,ws_father_module wsf,ws_member wm where wc.id={$_GET['cid']} and wc.module_id=wsm.id and wc.member_id=wm.id and wsf.father_module_id=wfm.id";*/
    //查询出对应帖子的信息
    $sql_content = "select * from ws_content where id={$_GET['cid']}";
    $result_content = execute($link, $sql_content);
    $data_content = fetch_array($result_content);
    $data_content['title'] = htmlspecialchars($data_content['title']);
    $data_content['content'] = nl2br($data_content['content']);

    //查询出对应帖子所属的子版块的信息
    $sql_son = "select * from ws_son_module where id={$data_content['module_id']}";
    $result_son = execute($link, $sql_son);
    $data_son = fetch_array($result_son);

    //查询出对应帖子所属的子版块对应的父版块的信息
    $sql_father = "select * from ws_father_module where id={$data_son['father_module_id']}";
    $result_father = execute($link, $sql_father);
    $data_father = fetch_array($result_father);

    //查询出会员信息
    $sql_member = "select * from ws_member where id={$data_content['member_id']}";
    $result_member = execute($link, $sql_member);
    $data_member = fetch_array($result_member);

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data_content['title'];?> - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/show.css">
</head>
<body>
	<?php require_once 'inc/header.inc.php';?>
	<div style="margin-top:55px;"></div>
	<div id="position" class="auto">
	 <a href="index.php">首页</a> &gt; <a href="list_father.php?id=<?php echo $data_father['id'];?>"><?php echo $data_father['module_name'];?></a> &gt; <a href="list_son.php?id=<?php echo $data_son['id'];?>"><?php echo $data_son['module_name'];?></a> &gt; <?php echo $data_content['title'];?>
	</div>
	<div id="main" class="auto">
		<div class="wrap1">
			<div class="pages">
			<?php
				$sql_sel = "select * from ws_reply where content_id={$_GET['cid']}";
				$result = execute($link, $sql_sel);
				$count = mysqli_num_rows($result);
				$page_size = 2;
		        $page = page($count, $page_size);
		           
			?>
			</div>
			<a class="btn reply" href="reply.php?cid=<?php echo $_GET['cid'];?>"></a>
			<div style="clear:both;"></div>
		</div>
	<?php if($_GET['page'] == 1){?>
		<div class="wrapContent">
			<div class="left">
				<div class="face">
					<a href="member.php?mid=<?php echo $member_id?>">
						<img width="120" height="120" src="<?php if($data_member['photo'] != ''){echo $data_member['photo'];}else{echo "images/2374101_middle.jpg";} ?>" />
					</a>
				</div>
				<div class="name">
					<a href=""><?php echo $data_member['user']; ?></a>
				</div>
			</div>
			<div class="right">
				<div class="title">
					<h2><?php echo $data_content['title'];?></h2>
					<span>阅读：<?php echo $data_content['times'];?>&nbsp;|&nbsp;回复：<?php echo $count?></span>
					<div style="clear:both;"></div>
				</div>
				<div class="pubdate">
					<span class="date">发布于：<?php echo $data_content['time'];?> </span>
					<span class="floor" style="color:red;font-size:14px;font-weight:bold;">楼主</span>
				</div>
				<div class="content">
					 <?php echo $data_content['content'];?>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	<?php }?>
	<?php
		$sql_sel = "select wm.user,wm.photo,wr.member_id,wr.time,wr.content,wr.id,wr.quote_id from ws_reply wr,ws_member wm where wr.member_id=wm.id and wr.content_id={$_GET['cid']} order by id asc {$page['limit']}";
		$result_reply = execute($link, $sql_sel);

		//楼层自增
		$floor = ($_GET['page']-1)*$page_size+1;
		
		while ($data_reply = fetch_array($result_reply)) {
	?>
		<div class="wrapContent">
			<div class="left">
				<div class="face">
					<a href="member.php?mid=<?php echo $data_reply['member_id']?>">
						<img width="120" height="120" src="<?php if($data_reply['photo'] != ''){echo $data_reply['photo'];}else{echo "images/2374101_middle.jpg";} ?>" />
					</a>
				</div>
				<div class="name">
					<a href="member.php?mid=<?php echo $data_reply['id']?>"><?php echo $data_reply['user'];?></a>
				</div>
			</div>
			<div class="right">
				
				<div class="pubdate">
					<span class="date">回复时间：<?php echo $data_reply['time'];?></span>
					<span class="floor"><?php echo $floor++;?>楼&nbsp;|&nbsp;<a href="quote.php?cid=<?php echo $_GET['cid'];?>&quote_id=<?php echo $data_reply['id'];?>">回复</a></span>
				</div>
				<div class="content">
				<?php if($data_reply['quote_id']){
					$sql = "select * from ws_reply where content_id={$_GET['cid']} and id<={$data_reply['quote_id']}";
					$i = nums($link, $sql); //楼层数

					$sql_sel = "select wr.content,wm.user from ws_reply wr,ws_member wm where wr.id={$data_reply['quote_id']} and wm.id=wr.member_id";
					$result = execute($link, $sql_sel);
					$data = fetch_array($result);

				?>
					<div class="quote">
						<h2>引用 <?php echo $i;?> 楼 <?php echo $data['user']?> 发表的: </h2>
						<?php echo $data['content'];?>
					</div>
				<?php }?>
					<?php 
						$data_reply['content'] = nl2br($data_reply['content']);
						echo $data_reply['content'];
					?>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
	<?php }?>
		<div class="wrap1">
			<div class="pages">
				<?php echo $page['html'];?>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>	
	
	<?php require_once 'inc/footer.inc.php';?>

</body>
</html>