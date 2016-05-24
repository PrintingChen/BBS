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

    //页面信息的查询
    $sql = "select * from ws_info where id=1";
    $result = execute($link, $sql);
    $data_info = fetch_array($result);

    $query="select * from ws_manage where id={$_SESSION['manage']['id']}";
    $result_manage=execute($link, $query);
    $data_manage=mysqli_fetch_assoc($result_manage);

    $query="select * from ws_father_module";
    $count_father_module=nums($link,$query);

    $query="select * from ws_son_module";
    $count_son_module=nums($link,$query);

    $query="select * from ws_content";
    $count_content=nums($link,$query);

    $query="select * from ws_reply";
    $count_reply=nums($link,$query);

    $query="select * from ws_member";
    $count_member=nums($link,$query);

    $query="select * from ws_manage";
    $count_manage=nums($link,$query);

    if($data_manage['level']=='0'){
      $data_manage['level']='普通管理员';
    }else{
      $data_manage['level']='超级管理员';
    }

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>系统信息 - <?php echo $data_info['index_title']?></title>
  <link rel="stylesheet" href="style/public.css">
  <link rel="stylesheet" href="style/index.css">
</head>
<body>
<?php include_once 'inc/header.inc.php';?>
<div id="main">
  <p class="titile">当前位置：系统信息</p>
  <div class="explain">
  <br/>
  欢迎您，<?php echo $data_manage['name']?>！！！
    <ul>
      <li></li>
      <li>所属角色：<?php echo $data_manage['level']?> </li>
      <li>创建时间：<?php echo $data_manage['create_time']?></li>
    </ul>
  </div>
  <div class="explain">
    <ul>
      <li>父版块(<?php echo $count_father_module?>)
                       子版块(<?php echo $count_son_module?>)
                       帖子(<?php echo $count_content?>)
                       回复(<?php echo $count_reply?>)
                       会员(<?php echo $count_member?>)
                       管理员(<?php echo $count_manage?>)
      </li>
    </ul>
  </div>
  <div class="explain">
    <ul>
      <li>服务器操作系统：<?php echo PHP_OS?> </li>
      <li>服务器软件：<?php echo $_SERVER['SERVER_SOFTWARE']?> </li>
      <li>MySQL 版本：<?php echo  mysqli_get_server_info($link)?></li>
      <li>PHP 版本：<?php echo phpversion()?></li>
      <li>最大上传文件：<?php echo ini_get('upload_max_filesize')?></li>
      <li>内存限制：<?php echo ini_get('memory_limit')?></li>
      <li><a target="_blank" href="phpinfo.php">PHP 配置信息</a></li>
    </ul>
  </div>
  
  <div class="explain">
    <ul>
      <li>程序安装位置(绝对路径)：<?php echo SA_PATH?></li>
      <li>程序在web根目录下的位置(首页的url地址)：<?php echo SUB_URL?></li>
      <li>程序版本：体育吧 V1.0</li>
      <li>程序开发者：陈印棠</li>
      <li>网站域名：暂无</li>
    </ul>
  </div>
</div>
</body>
</html>