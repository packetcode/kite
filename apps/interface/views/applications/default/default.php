<?php
	$route = kite::route('interface/routing/push');
	$basket = kite::getInstance('basket');
?>
<link href="<?php echo ROOT.'apps'.DS.'interface'.DS.'css'.DS.'routing.css';?>" rel="stylesheet">
<div class="well red " >
<h1>Applications</h1>
<p>
 A collection of apps,snippets,threads and themes and their configuration
</p>
</div>

<form role="form" action ="<?php echo ROOT.$route; ?>" method="post">
<div class="strip red"></div>
<div class="well">
  <h3>Apps</h3>
  <div >
	<?php foreach($basket->apps as $key => $value)
				echo "<div class='route'>$value</div>";
	?>
  </div>
 </div> 
 
 <div class="strip red"></div>
<div class="well">
  <h3>Snippets</h3>
  <div >
	<?php foreach($basket->snippets as $key => $value)
				echo "<div class='route'>$value</div>";
	?>
  </div>
 </div> 

 <div class="strip red"></div>
<div class="well">
  <h3>Threads</h3>
  <div >
	<?php foreach($basket->threads as $key => $value)
				if($value!='checkpoints')
				echo "<div class='route'>$value</div>";
	?>
  </div>
 </div> 

 <div class="strip red"></div>
<div class="well">
  <h3>Themes</h3>
  <div >
	<?php foreach($basket->themes as $key => $value)
				echo "<div class='route'>$value</div>";
	?>
  </div>
 </div> 
 
 </form>