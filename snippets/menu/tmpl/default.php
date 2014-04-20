
 <?php
	$packet = Kite::getInstance('packet');
	$params = $packet->get('params');
	$menu = $params->MENU;

 ?>
 <style type="text/css">
 ul.nav{
 	list-style-type: none;
 	padding:0px;
 	margin:0px;
 }

 ul.nav li{
 	display:inline;
 	color:white;
 	font-weight:bold;
 }

ul.nav a{
	text-decoration: none;
}
 ul.nav li {
 	padding:10px;
 	color:white;
 	border-radius: 5px;
 	transition: background-color 0.3s ease;
 }

 ul.nav li:hover{
 	background:#475D74;
 	padding:10px;
 	color:white;
 	border-radius: 5px;
 }
 .right{
 	float:right;
 }
 .nav-holder{
	display:none;
}

 </style>
 <div>
 <div class="right">
 	<div class="nav-holder">+ Menu</div>
 	<ul class="nav ">
 	<?php foreach($menu as $key => $value){ ?>
 		<a href="<?php echo ROOT; ?>"><li class=""><?php echo ucfirst($value);  ?></li></a>
 	<?php } ?>
	</ul>
</div>
</div>