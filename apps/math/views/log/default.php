<h1>
Log record
</h1>
<?php	$basket = KITE::getInstance('basket'); 


if(isset($basket->a0))
{
?>

<table class="table table-bordered">
	<tr>
		<th> id</th>
		<th>Operation</th>
		<th>a</th>
		<th>b</th>
		<th>result</th>
		<th>time_stamp</th>
	</tr>
<?php
foreach($basket as $key =>$value)
{	
?>	
	<tr>
		<td><?php echo $value['id']; ?></td>
		<td><?php echo $value['operation']; ?></td>
		<td><?php echo $value['a']; ?></td>
		<td><?php echo $value['b']; ?></td>
		<td><?php echo $value['result']; ?></td>
		<td><?php echo $value['time_stamp']; ?></td>
	</tr>
<?php
}
?>	
	
</table>
<?php
}else
	echo " <div class='well'>No records found !</div><br><br>";

?>