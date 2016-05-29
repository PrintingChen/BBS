$(function(){
    $('.collapsed').each(function(i){
        $(this).click(function(){
            $(this).css('background','url("images/collapsed_yes.png")');
            if($('.childlist').eq(i).css('display') == 'block'){
            	$('.childlist').eq(i).css('display','none');
            }else{
            	$(this).css('background','url("images/collapsed_no.png")');
            	$('.childlist').eq(i).css('display','block');
            }
        });
    });
});
