<?php 
    session_start();
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    //管理员是否登录
    if (!manage_login_state($link)) {
        skip_manage('login.php', 'error', '您还未登录！');
        exit();
    }

    $sql = "select * from ws_father_module";
    $result = execute($link, $sql);

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result1 = execute($link, $sql);
    $data_info = fetch_array($result1);
    
    if (isset($_POST['submit'])) {
        include 'inc/son_module_add.func.php'; //引入验证文件
        $clean = array(); //创建一个空数组用来存放过滤后的数据
        $clean['father_module_id'] = check_father_id($link, $_POST['father_module_id']);
        $clean['module_name'] = check_module_name($link, $_POST['module_name']);
        $clean['info'] = check_info($link, $_POST['info']);
        
        $sql_sel = "select * from ws_son_module where module_name='{$clean["module_name"]}'";
        if (nums($link, $sql_sel)) { //添加之前，判断是否已存在此子版块
            skip('son_module_add.php', 'error', '很抱歉添加失败,这个子版块已经存在！');
            exit();
        }
        
        $sql_ins = "insert into ws_son_module(father_module_id,module_name,info,member_id,sort) values({$clean['father_module_id']},'{$clean['module_name']}','{$clean['info']}',{$_POST["member_id"]},{$_POST["sort"]})";
        execute($link, $sql_ins);
        if (mysqli_affected_rows($link)) {
            skip('son_module.php', 'ok', '恭喜你，子版块添加成功！');
            exit();
        }else {
            skip('son_module.php_add', 'error', '很抱歉，子版块添加失败！');
            exit();
        }
    }
    
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/public.css">
<link rel="stylesheet" href="style/main.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/son_module_add.js"></script>
<title>添加子版块 - <?php echo $data_info['index_title'] ?></title>
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main">
    <p class="titile">当前位置：添加子版块</p>
    <form method="post">
        <table class="au">
            <tr>
                <td>所属父版块</td>
                <td>
                    <select name="father_module_id" class="father_module_id">
                        <option value="0">===请选择一个父版块===</option>
                        <?php 
                        while (@$data = fetch_array($result)){
                            echo "<option value='{$data['id']}'>{$data['module_name']}</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>*必须选一个所属的父版块</td>
            </tr>
    		<tr>
    			<td>子版块名称</td>
    			<td><input class="module_name" id="a" name="module_name" type="text"></td>
    			<td>*不得为空或大于50个字符</td>
    		</tr>
    		<tr>
    		    <td>子版块简介</td>
    		    <td><textarea class="info" name="info" style="width:310px;height:140px;"></textarea></td>
    		    <td>*不得超过255个字符</td>
    		</tr>
    		<tr>
    		    <td>版主</td>
    		    <td>
    		        <select name="member_id">
                    <option value="0">===请选择一个会员作为版主===</option>
                    <?php
                        $sql_member = "select * from ws_member";
                        $result_member = execute($link, $sql_member);
                        while($data_member = fetch_array($result_member)){
    		             echo "<option value='{$data_member['id']}'>{$data_member['user']}</option>";
                    }?>
    		        </select>
    		    </td>
    		    <td>*您可以在这里选择一个会员作为版主</td>
    		</tr>
    		<tr>
    			<td>排序</td>
    			<td><input name="sort" id="sort" type="text" value="0"></td>
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