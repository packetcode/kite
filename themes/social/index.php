<div class="header">
  <div class="container">
    <div class="bcol-30">
    <div class="logo">
    <?php kite::snippet('logo'); ?>
    </div>
  </div>
  <div class="bcol-70">
    <div class="menu">
    <?php kite::snippet('menu','social'); ?>
  </div>
  </div>
  <div class="clear"></div>
  </div>
</div>
<div class="container">
  <div class="body">
  <div class="bcol-left">
    <div><?php KITE::app() ?></div>
  </div>
  
  <div class="bcol-right">
    <div class="sticky">
      <div class="flip">
      <div class="flip-card green feed_menu">
        <ul class="feed_menu_list">
           <li><i class="fa fa-list-alt"></i><span class="flip-text">All Feeds</span></li>
          <a href="http://google.com"><li><i class="fa fa-bars"></i><span class="flip-text">Text Feeds</span></li></a>
          <li><i class="fa fa-picture-o"></i><span class="flip-text">Photo Feeds</span></li>
          <li> <i class="fa fa-video-camera"></i><span class="flip-text">Video Feeds</span></li>
          <li><i class="fa fa-code"></i><span class="flip-text">Link Feeds</span></li>
        </ul>
      </div>
      </div>
     </div> 
  </div>
  <div class="clear"></div>
  </div>  
</div>
<div class="footer">
  <div class="container">
  <?php kite::snippet('footer'); ?>
</div>
</div>