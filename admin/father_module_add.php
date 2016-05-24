<?php 
    session_start();
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect(); //数据库连接

    //管理员是否登录
    if (!manage_login_state($link)) {
        skip_manage('login.php', 'error', '您还未登录！');
        exit();
    }

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'add') {
            //引入验证文件
            include 'inc/father_module_add.func.php';
            //创建一个空数组来存放过滤之后的数据
            $clean = array();
            //开始验证
            $clean['module_name'] = check_module_name($link, $_POST['module_name']);
            $clean['sort'] = check_sort($_POST['sort']);
            //插入之前先判断是否有这条数据
            $sql_sel = "select * from ws_father_module where module_name='{$clean['module_name']}'";
            if (nums($link, $sql_sel) == 1) {
                skip('father_module_add.php', 'error', '已经存在这个父版块，添加失败！');
                exit();
            }
            
            //插入数据
            $sql_ins = "insert into ws_father_module(module_name,sort) values('{$clean['module_name']}','{$clean['sort']}')";
            execute($link, $sql_ins);
            if (mysqli_affected_rows($link)) {
                skip('father_module.php', 'ok', '添加成功！');
                exit();
            }else {
                skip('father_module.php', 'error', '添加失败！');
                exit();
            }
        }else {
            exit();
        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>添加父版块 - <?php echo $data_info['index_title']?></title>
<link rel="stylesheet" href="style/public.css"> 
<link rel="stylesheet" href="style/main.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/father_module_add.js"></script>
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main">
    <p class="titile">当前位置：添加父版块</p>
    <form action="father_module_add.php?action=add" method="post">
        <table class="au">
    		<tr>
    			<td>版块名称</td>
    			<td><input class="module_name" id="a" name="module_name" type="text"></td>
    			<td>*不得为空或大于50个字符</td>
    		</tr>
    		<tr>
    			<td>排序</td>
    			<td><input name="sort" id="sort" type="text"></td>
    			<td>*输入一个数字</td>
    		</tr>
    	</table>
    	<input class="btn submit" type="submit" name="submit" value="添 加" />
	</form>
</div>
<!--主面板结束-->
<!-- 弹框开始 -->
<div id="tip_win">
    <p class="tip_win_title">
        <span>删除提示</span>
        <a class="close" href="javascript:;"></a>
    </p>
    <div class="tip_delete"></div>
    <p class="tip_win_btn">
        <a id="delete_ok" class="tip_btn" href="#">确定</a>
    </p>
</div>
<div id="cover"></div>
<!-- 弹框结束-->
</body>
</html>