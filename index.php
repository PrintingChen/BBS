<?php
    //定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();

    //页面信息的查询
    $sql_info = "select * from ws_info where id=1";
    $result = execute($link, $sql_info);
    $data_info = fetch_array($result);

    //判断是否处于登录状态
    $member_id = login_state($link);
    
    $sql_sel = "select * from ws_father_module order by sort";
    $sql_total = "select * from ws_content";
    $sql_total_today = "select * from ws_content where time>CURDATE()";
    $sql_member = "select * from ws_member";
    $result_total = execute($link, $sql_total);
    $result_total_today = execute($link, $sql_total_today);
    $result_member = execute($link, $sql_member);
    $total = mysqli_num_rows($result_total);
    $total_today = mysqli_num_rows($result_total_today);
    $total_member = mysqli_num_rows($result_member);
    $result_father = execute($link, $sql_sel);  
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>首页 - <?php echo $data_info['index_title']?></title>
<link rel="stylesheet" href="style/public.css">
<link rel="stylesheet" href="style/common.css">
<link rel="stylesheet" href="style/index.css">
<script type="text/javascript" src="js/jquery-1.12.2.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<?php require_once 'inc/header.inc.php';?>
<div style="margin-top: 55px;"></div>
<div class="auto">
    <div class="chart clear">
        <p>今日：<em><?php echo $total_today?></em><span class="pipe">|</span>帖子：<em><?php echo $total?></em><span class="pipe">|</span>会员：<em><?php echo $total_member?></em></p>
        <div class="quick-thread-box">
            <a class="quick-thread" href="publish.php">我要发帖</a>
        </div>
    </div>

    <div class="quote_reply">
        <div class="latest_quote">
            <h4>最新发表</h4>
            <ul>
        <?php
            $sql = "select * from ws_content order by id desc limit 0,10";
            $result = execute($link, $sql);
            while($data = fetch_array($result)){
                $sql_son = "select wsm.module_name,wm.user from ws_son_module wsm,ws_member wm where wsm.id={$data['module_id']} and wm.id={$data['member_id']}";
                $result_son = execute($link, $sql_son);
                $data_son = fetch_array($result_son);
        ?>
                <li>[<?php echo $data_son['module_name']?>]&nbsp;<a href="show.php?cid=<?php echo $data['id'] ?>"><?php echo $data['title']?></a><span>[<?php echo $data_son['user']?>]</span></li>
        <?php }?>
            </ul>
        </div>
        <div class="latest_reply">
            <h4>最新回复</h4>
         <?php
            /*$sql = "select wc.title from ws_reply wr,ws_content wc where wr.content_id=wc.id order by id desc limit 0,10";
            $result = execute($link, $sql);
            while($data = fetch_array($result)){
                $sql_son = "select wsm.module_name,wm.user from ws_son_module wsm,ws_member wm where wsm.id={$data['module_id']} and wm.id={$data['member_id']}";
                $result_son = execute($link, $sql_son);
                $data_son = fetch_array($result_son);*/
        ?>
                <li>[子版块]&nbsp;<a href="show.php?cid=<?php  ?>"><?php ?></a><span>[作者]</span></li>
        <?php //}?>   
        </div>
    </div>

    <?php while (@$data_father = fetch_array($result_father)) { ?>
    <div class="box auto">
        <div class="title">
            <span class="collapsed"></span>
            <h2><a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a></h2>
        </div>
        <div class="childlist">
            <table class="cl">
                <tr class="cl_row">
        <?php 
        $sql_sel_son = "select * from ws_son_module where father_module_id={$data_father['id']}";
        $result_son = execute($link, $sql_sel_son);
        if (mysqli_num_rows($result_son)) {
            while (@$data_son = fetch_array($result_son)) { 
                $sql_total = "select * from ws_content where module_id={$data_son['id']}";
                $sql_today = "select * from ws_content where module_id={$data_son['id']} and time>CURDATE()";
                $result_total = execute($link, $sql_total);
                $result_today = execute($link, $sql_today);
                $count_total = mysqli_num_rows($result_total);
                $count_today = mysqli_num_rows($result_today);
                
        ?>
                <td class="cl_col">
                    <dl>
                        <dt><a href="list_son.php?id=<?php echo $data_son['id'];?>"><?php echo $data_son['module_name']?></a></dt>
                        <dd>今日：<?php echo $count_today?></dd>
                        <dd>帖子：<?php echo $count_total?></dd>
                    </dl>
                </td>
        <?php }?>
  <?php }else {?>
            <td>暂无子版块...</td>
  <?php }?> 
                </tr>
            </table>
        </div>
    </div>
    <?php }?>

    <?php require_once 'inc/footer.inc.php';?>
</div>


</body>
</html>
