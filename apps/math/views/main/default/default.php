<?php 
$basket = KITE::getInstance('basket');
$msg = $basket->get('msg');
?>

<div class="well">
<?php echo $msg; ?>
</div>