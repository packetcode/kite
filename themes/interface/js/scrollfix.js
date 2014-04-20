$(function(){

	$.fn.scrollfix = function(options){

		var settings = $.extend({
							element:"#scrollfix",
							top: "0px"
						}, options );
		

		var ele = $(settings.element);
		if(!ele.width())
		{
			return true;
		}
		
		var eleTop = ele.offset().top;
		var w = $(window).width();

		 $(window).scroll(function(){  
		 	var windowTop = $(window).scrollTop(); 
			var eleWidth = $(settings.element).width();
		      if (eleTop < windowTop &&  w> 490){
		      	if(settings.start)
					settings.start();
		        ele.css({ 'position': 'fixed', 'top': settings.top ,'width':eleWidth});

		      }else {
		      	if(settings.end)
					settings.end();
		        ele.css('position','static');
		        ele.css({'width':'100%'});
		      }
		    });

		$(window).resize(function(){   
			var e = $(settings.element).parent().width();	
		   ele.css({'width':e});
		  }); 

	};

});