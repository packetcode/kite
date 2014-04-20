<?php
	$node = kite::getInstance('node');
	$dashboard = $applications = $routing = $configuration = '';
	$item = $node->get('n2');
	$$item = 'active';
	$route = kite::route('interface');

?>
<div class="well dblue nopad" style="padding:13px">
<b >Administrator Menu</b>
</div>
<div class="menu">
	<a href="<?php echo ROOT.$route; ?>" class="<?php echo $dashboard; ?>">Dashboard</a>
	<a href="<?php echo ROOT.$route.'applications'; ?>" class="<?php echo $applications; ?>">Applications</a>
	<a href="<?php echo ROOT.$route.'routing'; ?>" class="<?php echo $routing; ?>">Routing</a>
	<a href="<?php echo ROOT.$route.'configuration'; ?>" class="<?php echo $configuration; ?>">Configuration</a>
</div>