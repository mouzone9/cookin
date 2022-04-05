
$(".slideshow").width($( window ).width()*($(".slideshow li").length*$(".slideshow").length));
if($(".slideshow li").length > $(".slideshow").length){
    console.log($(".slideshow li").length);
    $(function(){
        setInterval(function(){
           $(".slideshow ul").animate({marginLeft:-$( window ).width()},1000,function(){
              $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
           })
        }, 6000);
     });
}
