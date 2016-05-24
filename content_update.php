<?php
    //定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect(); /*数据库连接*/

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

    //判断是否处于登录的状态
	if (!$member_id = login_state($link)) {
		skip('login.php', 'error', '您没有登录！');
        exit();
	}

    /*判断cid的合法性*/
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip("member.php?mid=$member_id", 'error', '会员id传参错误！');
        exit();
    };

    //查询是否存在要修改的帖子信息
    $sql_content = "select * from ws_content where id={$_GET['cid']}";
    $result_content = execute($link, $sql_content);

    if (mysqli_num_rows($result_content) == 1) {
        $data_content = fetch_array($result_content);
        $data_content['title'] = htmlspecialchars($data_content['title']);
        if ($member_id == $data_content['member_id']) { //判断帖子楼主是否与操作者是同一个
            if (isset($_POST['submit'])) {
                include_once 'inc/publish.func.php'; //引入验证文件
                include_once 'inc/member.func.php';
                $clean = array();
                $clean['module_id'] = check_module1($link, $_POST['module_id']);
                $clean['title'] = check_title($link, $_POST['title']);
                $clean['content'] = escape($link, $_POST['content']);

                $sql = "update ws_content set module_id={$clean['module_id']},title='{$clean['title']}',content='{$clean['content']}' where id={$_GET['cid']}";
                execute($link, $sql);
                if (mysqli_affected_rows($link)) {
                    skip("member.php?mid={$data_content['member_id']}", 'ok', '恭喜你，修改帖子成功！');
                    exit();
                }else {
                    skip('index.php', 'error', '对不起，修改帖子失败！');
                    exit();
                }
            }
        }else{
            skip("member.php?mid={$data_content['member_id']}", 'error', '您没有权限修改！');
            exit();
        }
    }else {
        skip('index.php', 'error', '要修改的帖子不存在！');
        exit();
    }


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data_content['title']?> - <?php echo $data_info['index_title']?></title>
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
        $sql_father = "select * from ws_father_module";
        $result_father = execute($link, $sql_father);
        while (@$data_father = fetch_array($result_father)) {
           echo "<optgroup label='{$data_father['module_name']}'>";
           $sql_son = "select * from ws_son_module where father_module_id={$data_father['id']} order by sort";
           $result_son = execute($link, $sql_son); 
           while (@$data_son = fetch_array($result_son)){
                if ($data_content['module_id'] == $data_son['id']) {
                    echo "<option selected value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                }else{
                    echo "<option value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                }
                
           }
           echo "</optgroup>";
        }
        ?>
        </select>
        <input class="title" name="title" type="text" value="<?php echo $data_content['title']?>" />
        <textarea name="content" class="content" id="content"><?php echo $data_content['content']?></textarea>
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