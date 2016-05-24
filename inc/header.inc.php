<?php 
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
?>
<div class="header_wrap">
	<div id="header" class="auto">
		<div class="logo"><a href="index.php">体 育 吧</a></div>
		<ul class="list">
			<li><a class="curr" href="index.php">首页</a></li>
			<li><a href="#">导航一</a></li>
			<li><a href="#">导航二</a></li>
		</ul>
		<div class="login">
    		<form method="get" action="search.php">
                <input class="keyword" type="text" name="keywords" placeholder="输入关键字搜索" value="<?php if(isset($_GET['keywords'])){echo $_GET['keywords'];}?>" />
    	        <button class="submit" type="submit" name="button"><span class="bg_search"></span></button>
    	    </form>
    	    <?php 
    	    if (isset($_COOKIE['ws']['user']) && isset($_COOKIE['ws']['pwd'])){
    	        echo "<a target='_blank' href='member.php?mid={$member_id}' style='right:-50px;'>欢迎您，{$_COOKIE['ws']['user']}</a>";
                //echo "<a href='#'>退出</a>";
    	    }else {
    	        echo '<a class="signin" href="login.php">登录</a>';
    	        echo '<a class="register" href="register.php">注册</a>';
    	    }
    	    ?>
			
		</div>
	</div>
</div>
</body>
</html>