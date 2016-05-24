<?php 
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    /**
     * check_module() 过滤子版块
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_module1($link, $data){
        if (empty($data) || !is_numeric($data)) {
            skip("content_update.php?cid={$_GET['cid']}", 'error', '子版块名称不得为空！');
            exit();
        }
        $sql_sel = "select * from ws_son_module where id=$data";
        $res = execute($link, $sql_sel);
        if (nums($link, $sql_sel) != 1) {
            skip("content_update.php?cid={$_GET['cid']}", 'error', '这个版块信息不存在！');
            exit();
        }
        return escape($link, $data);
    }


?>