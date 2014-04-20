<div class="data" >
<?php
	$basket = kite::getInstance('basket');
	$data = $basket->get('data');
	if(isset($data->user))
		$data = $data->user;
	foreach($data as $key =>$value)
	{
?>
<div ><?php echo "<b>".ucfirst($key)."</b> : ".ucfirst($value); ?></div>
<?php 
	} 
?>
</div>