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
    /*验证cid*/
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip('index.php', 'error', 'id参数不合法！');
        exit();
    };
    
    /*验证quote_id*/
    if (!isset($_GET['quote_id']) || !is_numeric($_GET['quote_id'])){
        skip('index.php', 'error', '您要引用的回复id参数不合法！');
        exit();
    }
    $sql = "select * from ws_reply where id={$_GET['quote_id']} and content_id={$_GET['cid']}";
    $result = execute($link, $sql);
    $data = fetch_array($result);
    if (mysqli_num_rows($result) == 0) {
        skip('index.php', 'error', '您要引用回复子不存在！');
        exit();
    }

    //查询是否存在此帖子信息
    $sql = "select wc.content,wm.user from ws_content wc,ws_member wm where wc.id={$_GET['cid']} and wm.id=wc.member_id";
    $result = execute($link, $sql);
    $data = fetch_array($result);
    if (mysqli_num_rows($result) == 0) {
        skip('index.php', 'error', '此帖子不存在！');
        exit();
    }
    
    /*查询需要引用的回复信息*/
   	$sql_reply = "select wr.content,wm.user from ws_reply wr,ws_member wm where wr.id={$_GET['quote_id']} and wm.id=wr.member_id";
   	$result_reply = execute($link, $sql_reply);
   	$data_reply = fetch_array($result_reply);
   	$data_reply['content'] = nl2br($data_reply['content']);

    /*使用计算在这一条回复之前（包括这一条在内）的所以的记录数来算出楼层数*/
    $sql = "select * from ws_reply where content_id={$_GET['cid']} and id<={$_GET['quote_id']}";
    $floor = nums($link, $sql);

    //数据提交处理
    if (isset($_POST['submit'])) {
    	//引入验证文件
        include 'inc/reply.func.php';

        $clean = array();
        $clean['content'] = check_content($link, $_POST['content']);

        //将回复的数据入库
        $sql_ins = "insert into ws_reply(content_id,quote_id,content,member_id,time) values({$_GET['cid']}, {$_GET['quote_id']}, '{$clean['content']}', $member_id, now())";
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
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>帖子引用回复 - <?php echo $data_info['index_title']?></title>
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
                width : '928',
                height : '400'
            });
        });
    </script>
</head>
<body>
	<?php require_once 'inc/header.inc.php';?>
	<div style="margin-top:55px;"></div>
	<div id="position" class="auto">
		 <a href="index.php">首页</a> &gt; 引用回复
	</div>
	<div id="publish">
		楼主原帖：<div><?php echo $data['user'];?>: <?php echo $data['content'];?></div>
		<div class="quote">
			<p class="title">引用 <?php echo $floor?> 楼 <?php echo $data_reply['user'];?> 发表的: </p>
			<?php echo $data_reply['content']?>
		</div>
		<form method="post">
			<textarea name="content" class="content"></textarea>
			<input class="reply" type="submit" name="submit" value="" />
			<div style="clear:both;"></div>
		</form>
	</div>

	<?php require_once 'inc/footer.inc.php';?>
</body>
</html>