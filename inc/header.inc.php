<?php 
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    //头像地址
    $img_url = null;
    if (isset($member_id) && $member_id) {
        $member_sql = "select photo from ws_member where id={$member_id}";
        $member_result = execute($link, $member_sql); //出错点
        $member_data = fetch_array($member_result);
        if ($member_data['photo'] != '') {
            $img_url = $member_data['photo'];
        }else{
            $img_url = 'images/head.png';
        }
    }else{
        $img_url = 'images/head.png';
    }
     
?>
<div class="header_wrap">
	<div id="header" class="auto">
		<div class="logo"><a href="index.php">体 育 吧</a></div>
		<ul class="list">
			<li><a class="curr" href="index.php">首页</a></li>
		</ul>
		<div class="login">
    		<form method="get" action="search.php">
                <input class="keyword" type="text" name="keywords" placeholder="输入关键字搜索" value="<?php if(isset($_GET['keywords'])){echo $_GET['keywords'];}?>" />
    	        <button class="submit" type="submit" name="button"><span class="bg_search"></span></button>
    	    </form>
    	    <?php 
    	    if (isset($_COOKIE['ws']['user']) && isset($_COOKIE['ws']['pwd'])){
                //$html = <<<EOT
                    echo "<p class='person_center'>";
                    echo "<img src='{$img_url}'>";
                    echo "<ul class='person_list'>";
                    echo "<li><a href='member.php?mid={$member_id}'>我的主页</a></li>";
                    echo "<li><a href='logout.php'>退出</a></li>";
                    echo "</ul>";
                    echo "</p>";    
                    
//EOT;
               // echo $html;
    	       /* echo "<a target='_blank' href='member.php?mid={$member_id}' style='right:-50px;'>欢迎您，{$_COOKIE['ws']['user']}</a>";*/
    	    }else {
    	        echo '<a class="signin in" href="login.php">登录</a>';
    	        echo '<a class="register in" href="register.php">注册</a>';
    	    }
    	    ?>
			
		</div>
	</div>
</div>
</body>
</html>