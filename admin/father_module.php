<?php 
    session_start();
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';
    
    //数据查询
    $link = connect();
    //var_dump(manage_login_state($link));

    //管理员是否登录
   if (!manage_login_state($link)) {
        skip_manage('login.php', 'error', '您还未登录！');
        exit();
    }

    $sql = 'select * from ws_father_module';
    $result = execute($link, $sql);

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result1 = execute($link, $sql);
    $data_info = fetch_array($result1);
    
    if (isset($_POST['submit'])) {
        foreach ($_POST['sort'] as $key=>$val) {
            if (!is_numeric($val) || !is_numeric($key)) {
                skip('father_module.php', 'error', '排序参数错误！');
                exit();
            }
            $squery[] = "update ws_father_module set sort={$val} where id={$key}";
        }
        if (execute_multi($link, $squery, $error)) {
            skip('father_module.php', 'ok', '恭喜你，排序成功！');
            exit();
        }else {
            skip('father_module.php', 'error', '很抱歉，排序失败！');
            exit();
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>父版块 - <?php echo $data_info['index_title']?></title>
<link rel="stylesheet" href="style/public.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/father_module.js"></script>
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<!--主面板开始-->
<div id="main" style="height: 600px">
	<p class="titile">当前位置：父版块列表页</p>
	<form method="post">
	<table class="list">
		<tr>
			<th>排序</th>
			<th>版块名称</th>
			<th>版主</th>
			<th>操作</th>
		</tr>
<?php while (@$data = fetch_array($result)) {
        $html = <<<EOT
		<tr>
			<td><input class="sort" type="text" name="sort[{$data['id']}]" value="{$data['sort']}"></td>
			<td>{$data['module_name']}[id:{$data['id']}]</td>
			<td>张三</td>
			<td><a href="father_module_update.php?id={$data['id']}">[编辑]</a><a class="delete" href="javascript:tip({$data['id']});" id="{$data['id']}">[删除]</a></td>
		</tr>
EOT;
        echo $html;
      }
?>
	</table>
	<input class="btn" type="submit" name="submit" value="排 序" />
	</form>
</div>
<!--主面板结束-->
<!-- 弹框开始 -->
<?php prompt('确定要删除吗？')?>
<!-- 弹框结束-->
</body>
</html>