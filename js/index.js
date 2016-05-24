$(function(){
    $('.collapsed').each(function(i){
        $(this).click(function(){
            $(this).css('background','url("images/collapsed_yes.png")');
            $('.childlist').eq(i).css('display','none');
        });
    });
});
