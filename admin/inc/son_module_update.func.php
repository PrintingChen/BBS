<?php
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    /**
     * check_father_id() 判断父版块id是否存在
     * @param resource $link
     * @param number $id
     * 
     */
    function check_father_id($link, $id){
        if (!is_numeric($id)) {
            skip('son_module.php', 'error', '所属父版块不得为空！');
            exit();
        }
        
        $sql = "select * from ws_father_module where id={$id}";
        if (nums($link, $sql) == 0) {
            skip('son_module.php', 'error', '所属父版块不存在！');
            exit();
        }
        
        return $id;
    }
    
    /**
     * check_module_name() 检测版块名称是否合法
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_module_name($link, $data) {
        $data = trim($data); //去掉前后的空格
        $pattern = '/[<>\'\"\ \  ]/';
        if (empty($data)) {
            skip('son_module_update.php', 'error', '子版块名称不得为空！');
            exit();
        }
        //判断长度
        if (mb_strlen($data) > 50 && mb_strlen($data) < 0) {
            skip('son_module.php', 'error', '子版块名称不得大于50个字符！');
            exit();
        }
        //排除非法字符
        if (preg_match($pattern, $data)) {
            skip('son_module.php', 'error', '子版块名称不得包含非法字符！');
            exit();
        }
        return escape($link, $data);
    }

    /**
     * check_info() 检测简介信息
     * @param resource $link
     * @param string $data
     * @return Ambigous <string, string/array>
     */
    function check_info($link, $data){
        if (mb_strlen($data) > 255) {
            skip('son_module.php', 'error', '子版块简介长度不得超过255个字符！');
            exit();
        }
        return escape($link, $data);
    }

?>
