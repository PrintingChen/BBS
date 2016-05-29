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

    /*判断是否登录*/
    if(!($member_id = login_state($link))){
        skip('login.php', 'error', '请登录之后再回复！');
        exit();
    }
    /*判断id*/
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])) {
    	skip('index.php', 'error', '回复帖子的id不合法！');
        exit();
    }

    //查询是否存在此回复的帖子信息
    $sql_sel = "select wc.title,wc.id,wm.user from ws_content wc,ws_member wm where wc.id={$_GET['cid']} and wc.member_id=wm.id";
   	$result_sel = execute($link, $sql_sel);
    $data = fetch_array($result_sel);
    if (mysqli_num_rows($result_sel) != 1) {
        skip("index.php", 'error', '回复帖子的不存在！');
        exit();
    }

    //处理提交的数据
    if (isset($_POST['submit'])) {
        //引入验证文件
        include 'inc/reply.func.php';

        $clean = array();
        $clean['content'] = check_content($link, $_POST['content']);

        //将回复的数据入库
        $sql_ins = "insert into ws_reply(content_id,content,member_id,time) values({$_GET['cid']}, '{$clean['content']}', $member_id, now())";
        $result_ins = execute($link, $sql_ins);
        if (mysqli_affected_rows($link) == 1) {
            skip("show.php?cid={$_GET['cid']}", 'ok', '恭喜你，回复成功！');
            exit();
        }else {
            skip($_SERVER['REQUEST_URI'], 'error', '很抱歉，回复失败！');
            exit();
        }

    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>帖子回复 - <?php echo $data_info['index_title']?></title>
	<link rel="stylesheet" href="style/public.css">
	<link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/publish.css">
	<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
    <script type="text/javascript" src="kindeditor/kindeditor-all-min.js"></script>
    <script type="text/javascript" src="kindeditor/lang/zh-CN.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript">
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                allowFileManager : true,
                width : '850',
                height : '400'
            });
        });
    </script>

</head>
<body>
	<?php require_once 'inc/header.inc.php';?>
	<div style="margin-top:55px;"></div>
	<div id="position" class="auto">
		 <a href="index.php">首页</a> &gt; 回复帖子
	</div>
	<div id="publish">
		<div style="margin-bottom: 10px;">回复：由 <span style="color: #ffa640; font-weight: bold;"><?php echo $data['user']?></span> 发布的 <?php echo $data['title']?></div>
		<form method="POST" id="formReply">
			<textarea name="content" class="content"></textarea>
			<input class="reply" type="submit" name="submit" value="" />
			<div style="clear:both;"></div>
		</form>
	</div>

    <?php require_once 'inc/footer.inc.php';?>
</body>
</html>