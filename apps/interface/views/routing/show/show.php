<?php
	$basket = kite::getInstance('basket');
	
	//routes new oldefgh
	$delete = 		ROOT.kite::route('interface/routing/delete');
	$edit = 		ROOT.kite::route('interface/routing/edit');
	$show = 		kite::route('interface/routing/show');
	$def_set = 		ROOT.$show.'&def=set';
	$def_unset = 	ROOT.$show.'&def=unset';
	$enabletrue = 	ROOT.$show.'&enable=true';
	$disabletrue = 	ROOT.$show.'&enable=false';
	$route=			kite::getInstance('request')->get('route');
	$enable = 		$basket->get('enable');
	$status = 		$basket->get('status');

	//check the star color
	$star = 'white';
	if($basket->get('enable'))
		$star = '';
	if($basket->get("default")=="yes")
		$star = 'star';

	if($status)
			echo "<div class='alert green status'>$status</div>";
?> 
<div id="flip-head"class="well-header" >
<div class="well-header-in ">
<h2 >
<i class='fa fa-asterisk <?php echo $star; ?>' ></i> Route : <span class="route">/<?php echo $basket->get('route');?> </span>
</h2>
</div>
<div class="well-header-bn ">
<?php if($basket->get("default")=="no"){ ?>
   <a href="<?php echo $def_set.'&route='.$route; ?>"><button type="button" class="btn btn-big strong yellow"><i class='fa fa-asterisk' ></i> Set Default</button></a>
  <?php }else{ ?>
   <a href="<?php echo $def_unset.'&route='.$route; ?>"><button type="button" class="btn btn-big strong yellow"><i class='fa fa-asterisk' ></i> Unset Default</button></a>
  <?php } ?>
  <?php 
  if($route!='root.json'){
  if($enable =='1'){ ?>
   <a href="<?php echo $disabletrue.'&route='.$route; ?>"><button type="button" class="btn btn-big strong blu"><i class='fa fa-dot-circle-o' ></i> Disable</button></a>
  <?php }else{ ?> 
   <a href="<?php echo $enabletrue.'&route='.$route; ?>"><button type="button" class="btn btn-big strong blu"><i class='fa fa-dot-circle-o' ></i> Enable</button></a>
  <?php } }?>
   <a href="<?php echo $edit.'&route='.$route; ?>"><button type="submit" class="btn btn-big strong grn"><i class='fa fa-edit' ></i> Edit</button></a>
  <?php if($route!='root.json'){ ?>
   <a href="<?php echo $delete.'&route='.$route; ?>"><button type="button" class="btn btn-big strong red"><i class='fa fa-trash-o' ></i> Delete</button></a>
  <?php } ?>
</div>
</div>

<form role="form" action ="<?php echo ROOT.$route; ?>" method="post">
<div class="strip grey"></div>
<div class="well show-well">
<div class="bcol-30">
	<div class=""><h3>App Details </h3> </div>
	<div class="">
		<p><?php if($basket->get('app_application')!=null)echo "<b>Application:</b> ".$basket->get('app_application'); ?></p>
		<p><?php if($basket->get('app_controller')!=null)echo "<b>Controller:</b> ".$basket->get('app_controller'); ?></p>
		<p><?php if($basket->get('app_method')!=null)echo "<b>Method:</b> ".$basket->get('app_method'); ?></p>
		<p><?php if($basket->get('options')!=null)echo "<b>Options:</b> ".$basket->get('options'); ?></p>
		<p><?php if($basket->get('params')!=null)echo "<b>Parameters:</b> ".$basket->get('params'); ?></p>
	</div>
</div>
<div class="bcol-30">
	<div class=""><h3>Theme Details</h3> </div>
	<div class="">
		<p><?php if($basket->get('theme')!=null)echo "<b>Theme:</b> ".$basket->get('theme'); ?></p>
		<p><?php if($basket->get('layout')!=null)echo "<b>Layout:</b> ".$basket->get('layout'); ?></p>
	</div>
</div>
<div class="bcol-30">
	<div class=""><h3>Meta Details</h3> </div>
	<div class="">
		<p><?php if($basket->get('meta_title')!=null)echo "<b>Title:</b> ".$basket->get('meta_title'); ?></p>
		<p><?php if($basket->get('meta_desc')!=null)echo "<b>Description:</b> ".$basket->get('meta_desc'); ?></p>
		<p><?php if($basket->get('meta_author')!=null)echo "<b>Author:</b> ".$basket->get('meta_author'); ?></p>
		<p><?php if($basket->get('meta_keywords')!=null)echo "<b>Keywords:</b> ".$basket->get('meta_keywords'); ?></p>
	</div>
</div>
<div class="clear"></div>
</div>
</form>