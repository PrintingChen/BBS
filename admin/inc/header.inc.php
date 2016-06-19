<?php 
	//session_start();
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
?>
<!--头部开始-->
<div id="top">
	<div class="logo">后台管理</div>
	<ul class="nav">
	</ul>
	<div class="login_info">
		<a href="../index.php" target="_blank">网站首页</a>&nbsp;|
		管理员：<?php if(isset($_SESSION['manage'])){echo $_SESSION['manage']['name'];}?>[<a href="logout.php">注销</a>]
	</div>
</div>
<!--头部结束-->
<!--左侧栏开始-->
<div id="sidebar">
	<ul>
		<li>
			<p class="small_title system">系统管理</p>
			<ul class="child">
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='index.php'){echo "class='current'";}?> href="index.php">系统信息</a></li>
			<?php 
				if($_SESSION['manage']['level'] == 1){
			?>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='manage.php'){echo "class='current'";}?> href="manage.php">管理员</a></li>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='manage_add.php'){echo "class='current'";}?> href="manage_add.php">添加管理员</a></li>
			<?php }?>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='web_set.php'){echo "class='current'";}?> href="web_set.php">系统设置</a></li>
			</ul>
		</li>
		<li>
			<p class="small_title content">内容管理</p>
			<ul class="child">
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='father_module.php'){echo "class='current'";}?> href="father_module.php">父版块列表</a></li>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='father_module_add.php'){echo "class='current'";}?> href="father_module_add.php">添加父版块</a></li>
				<?php 
				 if (basename($_SERVER['SCRIPT_NAME'])=='father_module_update.php') {
				     echo "<li><a href='father_module_update.php' class='current'>修改父版块</a></li>";
				 }
				?>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='son_module.php'){echo "class='current'";}?> href="son_module.php">子版块列表</a></li>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='son_module_add.php'){echo "class='current'";}?> href="son_module_add.php">添加子版块</a></li>
				<?php 
				 if (basename($_SERVER['SCRIPT_NAME'])=='son_module_update.php') {
				     echo "<li><a href='son_module_update.php' class='current'>修改子版块</a></li>";
				 }
				?>
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='post_manage.php'){echo "class='current'";}?> href="post_manage.php">帖子管理</a></li>
			</ul>
		</li>
		<li>
			<p class="small_title user">用户管理</p>
			<ul class="child">
				<li><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='list_member.php'){echo "class='current'";}?> href="list_member.php">用户列表</a></li>
			</ul>
		</li>
	</ul>
</div>
<!--左侧栏结束-->