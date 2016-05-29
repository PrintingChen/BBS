<?php 
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);

    if(!$member_id = login_state($link)){
        skip('login.php', 'error', '请登录之后再发帖！');
        exit();
    }
    
    if (isset($_POST['submit'])) {
        include_once 'inc/publish.func.php'; //引入验证文件
        $clean = array();
        $clean['module_id'] = check_module($link, $_POST['module_id']);
        $clean['title'] = check_title($link, $_POST['title']);
        $clean['content'] = escape($link, $_POST['content']);
        $sql_ins = "insert into ws_content(module_id,title,content,time,member_id) values({$clean['module_id']},'{$clean['title']}','{$clean['content']}',now(),{$member_id})";
        execute($link, $sql_ins);
        if (mysqli_affected_rows($link) == 1) {
            $sql = "select * from ws_content order by time desc";
            $result = execute($link, $sql);
            $data = fetch_array($result);
            skip("show.php?cid={$data['id']}", 'ok', '恭喜你，发帖成功，请等待管理员审核！');
            exit();
        }else {
            skip('register.php', 'error', '很抱歉，发帖失败！');
            exit();
        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/public.css">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/publish.css">
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="kindeditor/kindeditor-all-min.js"></script>
<script type="text/javascript" src="kindeditor/lang/zh-CN.js"></script>
<script type="text/javascript" src="js/publish.js"></script>
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
<title>发布帖子 - <?php echo $data_info['index_title']?></title>
</head>
<body>
<?php require_once 'inc/header.inc.php';?>
<div style="margin-top:55px;"></div>
<div id="position" class="auto">
	 <a href="index.php">首页</a> > 发布帖子
</div>
<div id="publish">
	<form id="publist_form" method="post">
		<select name="module_id">
		<option>请选择一个子版块</option>
		<?php 
        $where = "";
        if (isset($_GET['father_module_id']) && is_numeric($_GET['father_module_id'])) {
            $where = " where id={$_GET['father_module_id']}";
        }
		$sql_father = "select * from ws_father_module{$where}";
		$result_father = execute($link, $sql_father);
		while (@$data_father = fetch_array($result_father)) {
		   echo "<optgroup label='{$data_father['module_name']}'>";
		   $sql_son = "select * from ws_son_module where father_module_id={$data_father['id']} order by sort";
		   $result_son = execute($link, $sql_son); 
		   while (@$data_son = fetch_array($result_son)){
                if (isset($_GET['son_module_id']) && $_GET['son_module_id'] == $data_son['id'] ) {
                    echo "<option selected value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                }else{
                    echo "<option value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                }
		        
		   }
		   echo "</optgroup>";
		}
		?>
		</select>
		<input class="title" placeholder="请输入标题(长度不得超过50个字符)" name="title" type="text" />
		<textarea name="content" class="content" id="content"></textarea>
		<input class="publish" type="submit" name="submit" value="" />
		<div style="clear: both;"></div>
	</form>
</div>
<!-- 弹框开始 -->
<div id="tip_win">
    <p class="tip_win_title">
        <span>删除提示</span>
        <a class="close" href="javascript:;"></a>
    </p>
    <div class="tip_delete"></div>
    <p class="tip_win_btn">
        <a id="delete_ok" class="tip_btn" href="javascript:void;">确定</a>
    </p>
</div>
<div id="cover"></div>
<!-- 弹框结束-->
<?php require_once 'inc/footer.inc.php';?>
</body>
</html>