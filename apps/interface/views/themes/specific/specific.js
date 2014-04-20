	$(function(){
		$('.menu_dir_name').append('<br>');
		$('.menu_dir_name').click(function(){
			var menu = $(this);
			menu.next('ul').slideToggle(function(){
				var i = menu.find('i');
				var clas = i.attr('class');
				if(clas == 'fa fa-folder-o')
				i.attr('class','fa fa-folder-open-o');
				else
				i.attr('class','fa fa-folder-o');
			});
		});

		$('.menu_dir_item').hover(function(){
			$(this).css("background-color","#95a5a6");
		},function(){
			$(this).css("background-color","transparent");
		});
		$('.menu_dir').click(function(){
			var menu = $(this);
			menu.nextAll('ul').slideToggle(function(){
				var i = menu.find('i');
				var clas = i.attr('class');
				if(clas == 'fa fa-caret-square-o-down')
				i.attr('class','fa fa-caret-square-o-up');
				else
				i.attr('class','fa fa-caret-square-o-down');
			});
		});

		$('.menu_dir_item').click(function(){
			//alert('a');
			var file = $(this).attr('url');
			var arr = ["php","css","json","js","html"];
          var file_valid = is_in_array(file.substr( (file.lastIndexOf('.') +1) ),arr);
          if(file_valid){
			$('.file').attr('value',file);
			$( ".form" ).submit();
			}
		});

		   function is_in_array(s,your_array) {
          for (var i = 0; i < your_array.length; i++) {
              if (your_array[i].toLowerCase() === s.toLowerCase()) return true;
          }
          return false;
      }
	});


