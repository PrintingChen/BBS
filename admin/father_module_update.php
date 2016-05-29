<?php
    session_start();
    define('ON', true); //定义常量ON来获取访问页面的权限
    require_once '../inc/common.inc.php'; //引入公共文件
    $link = connect(); //连接数据库

    //管理员是否登录
    if (!manage_login_state($link)) {
        skip_manage('login.php', 'error', '您还未登录！');
        exit();
    }

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result1 = execute($link, $sql);
    $data_info = fetch_array($result1);

    /*开始验证id*/
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { //判断id是否存在或为数字或数字字符串         
        skip('father_module.php', 'error', 'id参数错误！');
        exit();
    }
    $sql = "select * from ws_father_module where id={$_GET['id']}";
    if (!nums($link, $sql)) { //查询所是否存在此条记录
        skip('father_module.php', 'error', '这条版块信息不存在，请重试！');
        exit();
    }
    $result = execute($link, $sql);
    $data = fetch_array($result);
    
    //验证修改数据
    if (isset($_POST['submit'])) {
        include 'inc/father_module_update.func.php'; //引入验证文件
        $clean = array(); //创建一个空数组存放过滤后的数据
        $clean['module_name'] = check_module_name($link, $_POST['module_name']);
        $clean['sort'] = check_sort($_POST['sort']);
        //修改之前查询数据表是否已存在这条记录
        $sql_sel = "select * from ws_father_module where module_name='{$clean['module_name']}' and id!={$_GET['id']}";
        if (nums($link, $sql_sel)) {
            skip('father_module.php', 'error', '修改失败，这条版块信息已经存在！');
            exit();
        }
        //更新数据
        $sql = "update ws_father_module set module_name='{$clean['module_name']}',sort={$clean['sort']} where id={$_GET['id']}";
        execute($link, $sql);
        if (mysqli_affected_rows($link) == 1) {
            skip('father_module.php', 'ok', '修改成功！');
            exit();
        }else {
            skip('father_module.php', 'error', '修改失败！');
            exit();
        }
    }
   
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>修改父版块 - <?php echo $data_info['index_title']?></title>
<link rel="stylesheet" href="style/public.css"> 
<link rel="stylesheet" href="style/main.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/father_module_add.js"></script>
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main">
    <p class="titile">修改父版块 - <?php echo $data['module_name']?></p>
    <form method="post">
        <table class="au">
    		<tr>
    			<td>版块名称</td>
    			<td><input class="module_name" value="<?php echo $data['module_name']?>" name="module_name" type="text"></td>
    			<td>*不得为空或大于50个字符</td>
    		</tr>
    		<tr>
    			<td>排序</td>
    			<td><input name="sort" value="<?php echo $data['sort']?>" id="sort" type="text"></td>
    			<td>*输入一个数字</td>
    		</tr>
    	</table>
    	<input class="btn" type="submit" name="submit" value="修改" />
	</form>
</div>
<!--主面板结束-->
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
</body>