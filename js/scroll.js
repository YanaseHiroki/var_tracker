$(function(){
    $('a[href^="#"]').click(function(){
        var speed = 500;
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);

        //ヘッダーの高さを取得
        var header = $('header').height();
        
        //ヘッダーの高さを引く
        var position = target.offset().top - header;

        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });
  });