<?php $basket = KITE::getInstance('basket');
 ?>
<h3><?php echo $basket->get('title'); ?> </h3>
<p><?php echo $basket->get('content'); ?></p>