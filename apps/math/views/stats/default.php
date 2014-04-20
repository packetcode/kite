<h1>
Log record
</h1>
<?php	$basket = KITE::getInstance('basket'); 


if(isset($basket->a0))
{
?>

<table class="table table-bordered">
	<tr>
		<th> sno</th>
		<th> r</th>
		<th>p</th>
		<th>s</th>
		<th>o</th>
		<th>h</th>
		<th>l</th>
		<th>c</th>
		<th>pip</th>
		<th>hit</th>
		<th>max</th>
	</tr>
<?php
$i=$j=0;
foreach($basket as $key =>$value)
{	
	$i=$i+1;
?>	
	<tr>
	<td><?php echo $i; ?></td>
		<td><?php echo $value->r; ?></td>
		<td><?php echo $value->p; ?></td>
		<td><?php echo $value->s; ?></td>
		<td><?php echo $value->o; ?></td>
		<td><?php echo $value->h; ?></td>
		<td><?php echo $value->l; ?></td>
		<td><?php echo $value->c; ?></td>
		<td><?php echo $value->pip; ?></td>
		<?php if($value->hit == 'no') 
		{
		
				echo "<td><b style='background:red'>$value->hit</b></td>";
		}	else
		{
			echo "<td>$value->hit</td>";
		}
		?>
		
		<td><?php echo $value->max; ?></td>
	</tr>
<?php

}
?>	
	
</table>
<?php
	echo $i." ".$j;
}else
	echo " <div class='well'>No records found !</div><br><br>";

?>