
<?php
		$packet = kite::getInstance('packet');
?>
<br>
<div class="well ash nopad">
	<b>Info Box</b>
</div>	
<div class="well">
<div class="bcol-50">
	<div><b>Kite Version</b> : <?php echo $packet->get('version'); ?></div>
	<div><b>Routes</b> : <?php echo $packet->get('routes'); ?></div>
	<div class="strong">Configuration</div>
	<div>Default App : <?php echo $packet->get('app'); ?></div>
	<div>Default Theme : <?php echo $packet->get('theme'); ?></div>
	<div>secure : <?php echo $packet->get('secure'); ?></div>
</div>
<div class="bcol-50">
	<div class="strong">Applications</div>
	<div>Apps : <?php echo $packet->get('apps'); ?></div>
	<div>Snippets : <?php echo $packet->get('snippets'); ?></div>
	<div>Threads : <?php echo $packet->get('threads'); ?></div>
	<div>Themes : <?php echo $packet->get('themes'); ?></div>
</div>
<div class="clear"></div>
</div>
<br />

