
    var fil = document.getElementById("inpu").value;
    var ex = extension(fil);
     var m = "application/x-httpd-php"; 
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: ex,
        indentUnit: 4,
        theme:"blackboard",
        indentWithTabs: true
      });

    function extension(file) {
        var extension = file.substr( (file.lastIndexOf('.') +1) );
        switch(extension) {
            case 'json':
              return 'application/json';
            case 'js':
              return 'text/javascript';
            case 'html':
              return 'text/html ';
              case 'md':
              return 'text/x-markdown';
            case 'php':
              return 'application/x-httpd-php';
            case 'css':
              return 'text/css'
            default:
                return 'application/x-httpd-php'
        }
      }  

      function is_in_array(s,your_array) {
          for (var i = 0; i < your_array.length; i++) {
              if (your_array[i].toLowerCase() === s.toLowerCase()) return true;
          }
          return false;
      }

    $(function(){
      var ROOT = $('.root').attr('val');
      var save_url = $('.save_url').attr('val');
      var getcode_url = $('.getcode').attr('val');
      var height=$(document).height();
      var h_height = $('.save_block').height();
      var h = height-h_height-10;
      $('.CodeMirror').css({'height':h});

      var height=$(window).height();
      var h_height = $('.save_block').height();
      var h = height-h_height-60; 
       $('.CodeMirror').css({'height':h});

      $(window).resize(function(){ 
       var height=$(window).height();
      var h_height = $('.save_block').height();
      var h = height-h_height-60; 
       $('.CodeMirror').css({'height':h});
      });

      $('.saved').hide();
      $('.confirmation').hide();

      //saving data with keypress
      $(document).keydown(function(event) {
        var currKey=0,e=e||event; 
        currKey=e.keyCode||e.which||e.charCode;  //do this handle FF and IE
        if (!( String.fromCharCode(event.which).toLowerCase() == 's' && event.ctrlKey) && !(event.which == 19)) return true;
        event.preventDefault();
         editor.save();
          var file = $('.inpu').val();
          if(file){

          var code = $('#code').val();
          var ext = extension(file);
          var arr = ["php","css","json","js","html"];
          var file_valid = is_in_array(file.substr( (file.lastIndexOf('.') +1) ),arr);
          if(file_valid){
          $.post(save_url,{'file':file,'code':code},function(data){
            var obj = jQuery.parseJSON(data);
              $(".saved").text('## SUCCESS : Successfully Saved').slideDown().delay(2000).slideUp();
            });
          }else
            $(".saved").text('## ERROR : Invalid File Extension').slideDown().delay(2000).slideUp();
        }
        else
          $(".saved").text('## ERROR : Enter the file name').slideDown().delay(2000).slideUp();
        return false;
     });  

      //Keypress Enter to get file
      $(document).keypress(function(e) {
          if(e.which == 13) {
              var file = $('.inpu').val();
              if(file){
              var ext = extension(file);
              if(file)
              $.post(getcode_url,{'file':file},function(data){
                var obj = jQuery.parseJSON(data);
               // $('#code').html(obj.DATA);
               editor.setOption("mode",extension(file));
               editor.setValue(obj.DATA);
            });
          }else
          $(".saved").text('## ERROR : Enter the file name').slideDown().delay(2000).slideUp();
          }
      });


      $('.get').on('click',function(e){
      
          var file = $('.inpu').val();
          if(file){
          var ext = extension(file);
          $.post(getcode_url,{'file':file},function(data){
            var obj = jQuery.parseJSON(data);
           // $('#code').html(obj.DATA);
           editor.setOption("mode",extension(file));
           editor.setValue(obj.DATA);
        });}else
         $(".saved").text('## ERROR : Enter the file name').slideDown().delay(2000).slideUp();
        e.preventDefault();
      });


      // saving data on clicking save button
      $('.save').on('click',function(e){
          editor.save();
          var file = $('.inpu').val();
          if(file){
          var code = $('#code').val();
          var ext = extension(file);

           var arr = ["php","css","json","js","html"];
          var file_valid = is_in_array(file.substr( (file.lastIndexOf('.') +1) ),arr);
          if(file_valid){
          $.post(save_url,{'file':file,'code':code},function(data){
            var obj = jQuery.parseJSON(data);
             $(".saved").text('## SUCCESS : File Saved').slideDown().delay(2000).slideUp();
            });
          }else
            $(".saved").text('## ERROR : Invalid File Extension').slideDown().delay(2000).slideUp();
      }else
         $(".saved").text('## ERROR : Enter File Name').slideDown().delay(2000).slideUp();
        e.preventDefault();
      });

    });