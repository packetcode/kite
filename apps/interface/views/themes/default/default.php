<?php
	$route = kite::route('interface/themes');
	$basket = kite::getInstance('basket');
	$themes = $basket->get('themes');
?>
<div class="" >
<div class="bcol-15">
<div class="header_image">
<i class="fa fa-magic fa-5x"></i>
</div>
</div>
<div class="bcol-80">
<h1>Themes</h1>
<p>
Update the framework settings stored in config.json file with this interface.
</p>
</div>
<div class="clear"></div>
</div>
<table class="route_table">
<tr><th>Themes</th><th>Details</th></tr>
<?php foreach($themes as $key => $value) {?>
	<tr>
		<td><b><a href="<?php echo ROOT.$route.$value->ALIAS; ?>"><span ><i class='fa fa-asterisk star <?php if($value->DEFAULT == 'no') echo 'white'; ?>' ></i><span> <?php echo $value->NAME; ?></a></b></td>
		<td>
			<p><b>Author:</b> <?php echo $value->AUTHOR; ?> <br> 
				<b> Description:</b> <?php echo $value->DESC; ?><br>
				  <b>Version:</b> <?php echo  $value->VERSION; ?> <br>
				    <b>Default:</b> <?php echo  $value->DEFAULT; ?> <br>
				  <b>Website:</b> <?php echo  $value->WEBSITE; ?> 
			</p>
		</td>
	</tr>
  <?php }  ?>

 </table>