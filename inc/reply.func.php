<?php
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
    
    /**
     * check_content() 检测回复内容的合法性
     * @param  resource $link 
     * @param  string $data 回复的内容
     * @return 
     */
    function check_content($link, $data){
    	if (empty($data)) {
    		skip($_SERVER['REQUEST_URI'], 'error', '回复内容不得为空！');
            exit();
    	}	
    	
    	 return escape($link, $data);
    }


?>