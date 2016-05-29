<?php 
    //定义常量ON来获取访问页面的权限
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';

    $user = $_COOKIE['ws']['user'];
    $pwd = $_COOKIE['ws']['pwd'];

    //删除cookie
    if (isset($_COOKIE['ws']['user'])) {
        setcookie('user', "", time()-36000);
        setcookie('pwd', "", time()-36000);
   }

    if (!isset($_COOKIE['ws']['user']) && !isset($_COOKIE['ws']['user'])) {
        skip('index.php', 'ok', '您已成功退出！');
        exit();
    }

?>