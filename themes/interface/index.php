  <?php
  $logout = ROOT.kite::route('interface/root/logout');
  $viewsite = ROOT;
  $user = kite::getInstance('user');
      if($user->get('name'))
        $name = $user->get('name');
      else
        $name = 'Guest';
  ?>
  <div class="header-strip">
    <div class="container">
    <div class="wrap">
    <div  class="breadcrumb">
      <div class="logo_header"><?php kite::snippet('logo'); ?>
        <span class='pull-right pad-top'> <a href='<?php echo $viewsite; ?>' target="_blank" ><i class='fa fa-desktop' ></i> View Site</a>    
			<a href='<?php echo $logout; ?>'><i class='fa fa-power-off' ></i> logout </a></span>
      </div>
    </div>
    </div>  
  </div>
  </div>
  <div class="wrap">
  <div class="main container padding">
  <div class="bcol-left">
    <?php kite::snippet('menu','interface'); ?>
  </div>

  	<div class="bcol-right">
      <div class="brdcrm"><?php kite::snippet('breadcrumb'); ?></div>
      <div class="app trans"><?php KITE::app() ?></div>
    </div>	
      <div class="clear"></div>
	</div>
	</div>
	<div class="bottom-strip">
    <div class="container"><div class="bottom-strip-inner"></div></div>
  </div>
	<div class="footer">
	<div class="logo main-logo"><?php Kite::snippet('footer'); ?></div>
	</div>

