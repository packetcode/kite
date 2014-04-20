<?php $image = kite::getInstance('packet')->getParams('image'); 
		$url = ROOT.kite::route('interface');
?>
<a href="<?php echo $url; ?>" ><img  class="logo_img" src="<?php echo ROOT; ?>img/<?php echo $image; ?>" /></a>