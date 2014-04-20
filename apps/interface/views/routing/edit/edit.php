
<?php
	$basket = kite::getInstance('basket');
	
	//routes
	$put = ROOT.kite::route('interface/routing/put');
	$show = ROOT.kite::route('interface/routing/show');

	$route=kite::getInstance('request')->get('route');
	$enable = $basket->get('enable');
	$status = $basket->get('status');

	//check the star color
	$star = 'white';
	$def = 'no';
	if($basket->get('enable'))
		$star = '';
	if($basket->get("default")=="yes")
	{
		$star = 'star';
		$def = 'yes';
	}	

	if($status)
			echo "<div class='alert green status'>$status</div>";

?>

<form role="form" action ="<?php echo $put; ?>" method="post">
<div class="well-header" >
<div class="well-header-in ">
<h2 >
<i class='fa fa-asterisk <?php echo $star; ?>' ></i> Route : <span class="route">/<?php echo $basket->get('route');?> </span>
</h2>
</div>
<div class="well-header-bn ">

 <button type="submit" class="btn btn-big strong yellow"><i class='fa fa-edit' ></i> Save</button>

 <a href="<?php echo $show.'&route='.$route; ?>"><button type="button" class="btn btn-big strong grn"><i class='fa fa-square-o' ></i> Cancel</button></a>

</div>
</div>

<div class="strip grey"></div>
<div class="well">
<div class="bcol-33">
	<div class="pad10">
	<div class=""><h3>App Details </h3> </div>
	<div class="">
		<p><b>Application:</b> <input type="text" name="app_application" value="<?php echo $basket->get('app_application'); ?>" /></p>
		<p><b>Controller:</b> <input type="text" name="app_controller" value="<?php echo $basket->get('app_controller'); ?>" /></p>
		<p><b>Method:</b> <input type="text" name="app_method" value="<?php echo $basket->get('app_method'); ?>" /></p>
		<p><b>Options:</b> <input type="text" name="options" value="<?php echo $basket->get('options'); ?>" /></p>
		<p><b>Parameters:</b> <input type="text" name="params" value="<?php echo $basket->get('params'); ?>" /></p>
		</div>
	</div>
</div>
<div class="bcol-33">
	<div class="pad10">
	<div class=""><h3>Theme Details</h3> </div>
	<div class="">
		<p><b>Theme:</b> <input type="text" name="theme_r" value="<?php echo $basket->get('theme'); ?>" /></p>
		<p><b>Layout:</b> <input type="text" name="layout_r" value="<?php echo $basket->get('layout'); ?>" /></p>	
	</div>
</div>
</div>
<div class="bcol-33">
	<div class="pad10">
	<div class=""><h3>Meta Details</h3> </div>
	<div class="">
		<p><b>Title:</b> <input type="text" name="meta_title" value="<?php echo $basket->get('meta_title'); ?>" /></p>
		<p><b>Description:</b><textarea name="meta_desc" rows="6"><?php echo $basket->get('meta_desc'); ?></textarea></p>
		
		<p><b>Author:</b> <input type="text" name="meta_author" value="<?php echo $basket->get('meta_author'); ?>" /></p>
		<p><b>Keyword:</b> <input type="text" name="meta_keywords" value="<?php echo $basket->get('meta_keywords'); ?>" /></p>
	</div>
	</div>
</div>
<div class="clear"></div>
<input type="hidden" name="file" value="<?php echo $basket->get('file'); ?>" />
<input type="hidden" name="app_file" value="<?php echo $basket->get('app_file'); ?>" />
<input type="hidden" name="route" value="<?php echo $basket->get('route'); ?>" />
<input type="hidden" name="default" value="<?php echo $def ?>" />
</div>


</form>