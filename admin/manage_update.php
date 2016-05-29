<?php
    session_start();
    define('ON', true); //定义常量ON来获取访问页面的权限
    require_once '../inc/common.inc.php'; //引入公共文件

    $link = connect();
	
    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result1 = execute($link, $sql);
    $data_info = fetch_array($result1);

    //管理员是否登录
    if (!manage_login_state($link)) {
        skip_manage('login.php', 'error', '您还未登录！');
        exit();
    }

	//判断是否为超级管理员，只有超级管理员才有权限访问此页面
	$sql_manage = "select * from ws_manage where name='{$_SESSION['manage']['name']}'";
	$result_manage = execute($link, $sql_manage);
	$data_manage = fetch_array($result_manage);
	if ($data_manage['level'] != '1'){
		skip_manage('index.php', 'error', '您不是超级管理员，没有权限访问！');
        exit();
	}

    /*开始验证id*/
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { //判断id是否存在或为数字或数字字符串         
        skip('manage.php', 'error', '管理员id传参错误！');
        exit();
    }
    $sql = "select * from ws_manage where id={$_GET['id']}";
    if (!nums($link, $sql)) { //判断是否存在该管理员信息
        skip('manage.php', 'error', '对不起，您要修改的管理员信息不存在！');
        exit();
    }
    $result = execute($link, $sql);
    $data = fetch_array($result);
    //验证修改数据
    if (isset($_POST['submit'])) {
        //引入验证文件
        include_once 'inc/manage_add.func.php';
        $clean = array();
        $clean['level'] = check_level($link, $_POST['level']);

        //更新数据
        $sql_ins = "update ws_manage set level={$clean['level']} where id={$_GET['id']}";
        execute($link, $sql_ins);
        if (mysqli_affected_rows($link)) {
            skip('manage.php', 'ok', '修改成功！');
            exit();
        }else {
            skip('manage.php', 'error', '修改失败！');
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
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main">
    <p class="titile">当前位置：修改管理员</p>
    <form method="post">
        <table class="au">
            <tr>
                <td>管理员名称</td>
                <td><input class="manage_name" disabled="disabled" id="a" name="name" type="text" value="<?php echo $data['name']?>"></td>
            </tr>
            <tr>
                <td>管理员等级</td>
                <td>
                    <select name="level">
                        <option value="0">普通管理员</option>
                        <option value="1">超级管理员</option>
                    </select>
                </td>
                <td>*请选择一个等级</td>
            </tr>
        </table>
        <input class="btn submit" type="submit" name="submit" value="修改" />
    </form>
</div>

</body>