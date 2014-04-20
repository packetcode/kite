<?php
$basket = KITE::getInstance('basket');
$result = $basket->get('result');
$operation = $basket->get('operation');
$route = kite::route("math/root/$operation"); 
?>

<div class="well">
<h2> <?php echo $operation; ?> of two numbers </h2>
	<form action="<?php echo ROOT.$route; ?>" method="post">
		<div style="width:300px;padding:10px">
			<input type="text" class="form-control" name="a" placeholder="Enter a number">
		</div>
		<div style="width:300px;padding:10px">
			<input type="text" class="form-control" name="b" placeholder="Enter another number">
		</div>
		<div style="width:300px;padding:10px">
			<button class="btn btn-primary" type="submit" ><?php echo $operation; ?></button>
		</div>
	</form>
</div>

<?php 
if(isset($basket->result))
{
?>
<div class="well">
	RESULT :<b> <?php echo $result; ?></b>
</div>
<?php
}
?>