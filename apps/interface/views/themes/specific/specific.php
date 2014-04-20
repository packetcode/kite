<div class="bg">
<?php
	$router = ROOT.kite::route('interface/tools/editor');
?>

<?php
	$route = kite::route('interface/themes');
	$basket = kite::getInstance('basket');
	$theme = $basket->get('theme');
	$alias = $theme->ALIAS;
	
	$theme_pic = 'themes/'.$alias.'/theme.jpg';
	$default_theme_pic = 'img/default_theme_pic.jpg';
	if(file_exists($theme_pic))
		$theme_image = $theme_pic;
	else
		$theme_image = $default_theme_pic;
	

	$save = ROOT.kite::route('interface/themes/paramsave');
?>
<div class="main-th">
<div >
	<div class="theme_header">
	<div class="bcol-30">
		<div class="theme_image_div">
			<img src="<?php echo ROOT.$theme_image; ?>" class="theme_image"/>
		</div>	
	</div>
	<div class="bcol-70">
	<div class="theme_details">
		<h1><?php echo $theme->NAME; ?></h1>	
		<div><?php echo $theme->DESC; ?><br> </div>
		<div class="theme_details_">
			<b>Version:</b> <?php echo $theme->VERSION; ?> &nbsp;&nbsp;
			<b>Author:</b> <?php echo $theme->AUTHOR; ?> &nbsp;&nbsp;
			<b>Website:</b> <?php echo $theme->WEBSITE; ?>
		</div>
	</div>
	</div>
	<div class="clear"></div>
	</div>
	<div class="well-header-bn ">
		<button type="submit" class="btn btn-big strong  ">
			<i class='fa fa-dot-circle-o' ></i> Save Configuration</button>
		<button type="submit" class="btn btn-big strong blu ">
			<i class='fa fa-dot-circle-o' ></i> Enable Theme</button>
		<button type="submit" class="btn btn-big strong  red">
			<i class='fa fa-trash-o' ></i> Delete Theme</button>
	</div>
</div>
	<div class="theme_params">
		<div class="bcol-60">
			<div class="theme_params_main">
				<h2>Configuration</h2>
				<div class="well-head"><b>Preset</b><br></div>
				<div class='well'>
					<select name="preset" class="w100">
						<option value="default">Default</option>
					</select>
				</div>
				<div class="well-head"><b>Paramters</b><br></div>
				<div class='well'>
					<form method="post" action="<?php echo $save; ?>" >
					<?php 
						$file = 'themes/'.$alias.'/params.php';
						if(file_exists($file)){
								require_once $file; 
							?>
						<input name="theme" type="hidden" value="<?php echo $alias; ?>" /><br>
						<button type="submit" class="btn btn-big green" value="save" >save</button>
						<?php }else
						echo "Paramters Not Defined";		
					?>
					</form>
				</div>
			</div>
		</div>
		<div class="bcol-40">
			<div class="theme_listing">
				<h2>Files</h2>
				<form class="form" action="<?php echo $router; ?>" method="post">
				<?php echo $basket->get('menu'); ?>
				<input type="hidden" class='file' name="file" value=""/>
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<div >

</div>
</div>
</div>