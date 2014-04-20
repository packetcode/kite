
$(function(){

   $(this).scrollfix({
      element:"#flip-head"
   });

   $(this).scrollfix({
      element:"#sticky",
      top:"10px",
      start: function(){
        var scroll = $('.scroll').width();
        if(!scroll){
          $(this.element).find('ul').prepend("<li class='scroll'><i class='fa fa-arrow-up'></i> SCROLL UP</li>");
          $('.scroll').hide();
          $('.scroll').slideDown();
        }
        $('.scroll').css({background:'#16a085'});   
      },
      end:function(){
        $('.scroll').remove();
      }
   });

    $('body').on('click','.scroll',function(){
    $("html, body").animate({ scrollTop: 0 }, 1300);
    });

});
