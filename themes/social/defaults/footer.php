
<script src="https://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript"></script>
<script>
$(function(){
	var menu = $('.nav');
	$('.nav-holder').on('click', function(e) {  
        e.preventDefault();  
        $(menu).slideToggle();  
    });  

    $(window).resize(function(){  
    var w = $(window).width();  
    if(w > 400 && menu.is(':hidden')) {  
        menu.removeAttr('style');  
    }  
	});

    //sticky sidebar
	var stickyTop = $('.sticky').offset().top; // returns number 
 
 	 $(window).scroll(function(){ // scroll event  
 		var windowTop = $(window).scrollTop(); // returns number
 		var eleWidth = $('.flip').width();
 		  var w = $(window).width();  
    	if (stickyTop < windowTop &&  w> 490){
      	$('.sticky').css({ position: 'fixed', top: 10 });
      	$('.flip').css({'width':eleWidth});
    		}
    	else {
      	$('.sticky').css('position','static');
      	$('.flip').css({width:'100%'});
    	}
 
  });

});
</script>
  </body>
</html>
