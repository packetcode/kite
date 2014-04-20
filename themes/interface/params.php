<?php
	$params = kite::getInstance('basket')->get('params');
?>
<style>
	lable{
		font-weight:bold;
	}
</style>
	<lable>Background:</lable>
	<input name="background" type="text" class="w100" value="<?php echo $params->BACKGROUND; ?>"/>
	<lable>Color:</lable>
	<input name="color" type="text" class="w100"value="<?php echo $params->COLOR; ?>"/>

