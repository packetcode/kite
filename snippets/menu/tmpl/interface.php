  <?php
    $route = ROOT.kite::route('interface');
  ?>
    <div id="sticky" >
      <div class="flip">
      <div class="flip-card green feed_menu">
        <ul class="nav feed_menu_list">
          <a href="<?php echo $route; ?>"> <li><i class="fa fa-list-alt"></i><span class="flip-text">Dashboard</span></li></a>
          <a href="<?php echo $route; ?>apps"><li><i class="fa fa-credit-card"></i><span class="flip-text">Apps</span></li></a>
          <a href="<?php echo $route; ?>snippets"><li><i class="fa fa-print"></i><span class="flip-text">Snippets</span></li></a>
          <a href="<?php echo $route; ?>threads"><li> <i class="fa fa-tasks"></i><span class="flip-text">Threads</span></li></a>
          <a href="<?php echo $route; ?>themes"><li><i class="fa fa-magic	"></i><span class="flip-text">Themes</span></li></a>
          <a href="<?php echo $route; ?>tools"><li><i class="fa fa-flask	"></i><span class="flip-text">Tools</span></li></a>
          <a href="<?php echo $route; ?>routing"><li><i class="fa fa-truck	"></i><span class="flip-text">Routing</span></li></a>
          <a href="<?php echo $route; ?>configuration"><li><i class="fa fa-gear	"></i><span class="flip-text">Configuration</span></li></a>
        </ul>
      </div>
      </div>
     </div> 
     <div>&nbsp; </div>