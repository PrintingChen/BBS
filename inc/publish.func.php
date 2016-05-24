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
    function check_module($link, $data){
        if (empty($data) || !is_numeric($data)) {
            skip('publish.php', 'error', '子版块名称不得为空！');
            exit();
        }
        $sql_sel = "select * from ws_son_module where id=$data";
        $res = execute($link, $sql_sel);
        if (nums($link, $sql_sel) != 1) {
            skip('publish.php', 'error', '这个版块信息不存在！');
            exit();
        }
        return escape($link, $data);
    }
    
    /**
     * check_title() 过滤标题
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_title($link, $data){
        if (empty(mb_strlen($data))) {
            skip('publish.php', 'error', '标题不得为空！');
            exit();
        }
        if (mb_strlen($data) > 50) {
            skip('publish.php', 'error', '标题长度不得超过50个字符！');
            exit();
        }
        
        return escape($link, $data);
    }
    
        
?>