<?php 
//定义常量ON来获取访问页面的权限
define('ON', true);
//引入公共文件
require_once 'inc/common.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="Keywords" content="">
<meta name="Description" content="">
<title>Insert title here</title>
</head>
<body>
<?php
	setcookie("a", '123', time()+100);

	setcookie("a", '', time()-100);


	print_r($_COOKIE['a']);



?>
</body>
</html>