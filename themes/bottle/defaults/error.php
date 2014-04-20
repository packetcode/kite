
  <div id="body-wrapper">
    <div class="wrap">

  <div class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
       <?php Kite::snippet('menu');?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">
	<?php Kite::snippet('logo'); ?>
    <?php KITE::app() ?>	
		 <div class="footer">
		 <hr>
	<?php Kite::snippet('footer'); ?>
    </div><!-- /.container -->
	
	</div>
	</div>
