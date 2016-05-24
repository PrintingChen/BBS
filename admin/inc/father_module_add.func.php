<?php 
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
    
    /**
     * check_module_name() 检测版块名称是否合法
     * @param string $data
     * @return string $data
     */
    function check_module_name($link, $data){
        $data = trim($data); //去掉前后的空格
        $pattern = '/[<>\'\"\ \  ]/';
        if (empty($data)) {
            skip('father_module_add.php', 'error', '版块名称不得为空！');
            exit();
        }
        //判断长度 
        if (mb_strlen($data) > 50 && mb_strlen($data) < 0) {
            skip('father_module_add.php', 'error', '版块名称不得大于50个字符！');
            exit();
        }
        //排除非法字符
        if (preg_match($pattern, $data)) {
            skip('father_module_add.php', 'error', '版块名称不得包含非法字符！');
            exit();
        }
        return escape($link, $data);
    }
    
    /**
     * check_sort() 检测sort的值是否为数字
     * @param string $data 传入的数据
     * @return string $data
     */
    function check_sort($data) {
        $pattern = '/\d/';
        if (!preg_match($pattern, $data)) {
            skip('father_module_add.php', 'error', '排序必须为数字！');
            exit();
        }
        return $data;
    }
    
    
?>
