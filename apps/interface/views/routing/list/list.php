<?php $basket = kite::getInstance('basket');
$route_put = kite::route('interface/routing/show');
$route_purge = kite::route('interface/routing/purge');
$route_push = kite::route('interface/routing/push');
$route_add = kite::route('interface/routing/add');
$status = $basket->get('status');
	if($status !=null)
		echo "<div class='alert status green'>$status</div>";
	$routes = $basket->route;
?>

<div id="flip-head" >
<div class="bcol-15">
<div class="header_image">
<i class="fa fa-truck fa-5x"></i>
</div>
</div>
<div class="bcol-85">
<h1>Routing  
<a href="<?php echo ROOT.$route_add; ?>" >
<button type="button" class="btn btn-big strong pull-right"><i class='fa fa-edit' ></i> Add Route</button>
</a>
</h1>
<p>
To make it convenient 
With this interface you can add/delete/update a custom route.
</p>
</div>
<div class="clear"></div>
<div class="strip grey"></div>
</div>

<div class="">
<table class="route_table" border="0" cellspacing="0" cellpadding="0">
<?php
	echo "<tr><th>Custom Route</th><th>Application Route</th></tr>";
foreach($routes as $key => $value)
{
	$router= $value->route;
	$data= $value->data;

	echo "<tr>";
	echo "<td style='vertical-align:top'>";

	foreach($data as $a =>$b)
	{
		if($a!='R01')
		{
			$route = $b->NODE;
			$url = $b->FILE;
			echo "<div><a href='".ROOT.$route_put."&route=$url' >";
			if($b->ENABLE != '1')
			{
				echo "<span ><i class='fa fa-asterisk white' ></i><span>";
			}
			else{
				if($data->R01== $a)
				echo "<span ><i class='fa fa-asterisk star' ></i><span>";
				else
				echo "<span ><i class='fa fa-asterisk ' ></i><span>";
			}
			
			
			
			echo " ".$route."</a> &nbsp;";
			echo "</div>";
		}
	}
	echo "</td>";
		echo "<td > $router </td>";
	echo "</tr>";

}	
	?>
	</table><br>
	<div class='route_table_footer'>
	<span ><i class='fa fa-asterisk star' ></i> Default<span> &nbsp;&nbsp;
		<span ><i class='fa fa-asterisk ' ></i> Enabled<span> &nbsp;&nbsp;
			<span ><i class='fa fa-asterisk white' ></i> Disabled<span>
	</div>
		
</div>	