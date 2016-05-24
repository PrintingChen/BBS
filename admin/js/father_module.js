$(function(){
	
	//点击取消按钮
	$('#delete_cancel').click(function(){
		$('#cover').fadeOut(300);
		$('#tip_win').slideUp(500);
	});
	//点击关闭按钮
	$('.close').click(function(){
		$('#cover').fadeOut(300);
		$('#tip_win').slideUp(500);
	});	
});

/**
 * tip() 确实是否要删除数据
 * @param number id 
 * @return void
 */
function tip(id){
	$('#cover').fadeIn(300);
	$('#tip_win').slideDown(500);
	$('#delete_ok').attr('href','father_module_delete.php?id='+id+'');
}
