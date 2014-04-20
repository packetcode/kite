
<div class="block">
<div class="bcol-600px">
<div class="sheet">
	<div class="well"><h3>Members</h3></div>
	<div class="list"><?php
	echo "<a href=''>ALL</a> - ";
	foreach (range('A', 'Z') as $char) {
    echo "<a href=''><span class='alphabet'>".$char ."</span></a> ";
}
	?></div>
	<?php
		for($i=1;$i<8;$i=$i+2)
		{
	?>
	<div class="row">
	<div class="bcol-50">
	<div class="member">
		<div class="bcol-40">
		<div class="member_img"><img src="<?php echo ROOT; ?>img/users/<?php echo $i;?>.png" class="member_user_img"/></div>
		</div>
		<div class="bcol-60">
		<div class="member_name"><a href="#">Krishna Teja</a></div>
		<button class="button member_button" >follow</button>
		</div>
		<Div class="clear"></div>
	</div>
	</div>
	<div class="bcol-50">
		<div class="member">
		<div class="bcol-40">
		<div class="member_img"><img src="<?php echo ROOT; ?>img/users/<?php echo $i+1;?>.png" class="member_user_img"/></div>
		</div>
		<div class="bcol-60">
		<div class="member_name"><a href="#">Poojitha</a></div>
		<button class="button member_button" >follow</button>
		</div>
		<Div class="clear"></div>
	</div>
	</div>
	<div class="clear"></div>
	</div>
	<?php
	}
	?>
	<div class="pagination">
		<ul>
			<li> 1</li>
			<li> 2</li>
			<li> 3</li>
			<li> 4</li>
			<li> 5</li>
			<li>next</li>
		</ul>
	
	</div>
</div>	

</div>
<div class="bcol-300px">
	
	<div class="flip">
	<div class="flip-top-red">
		Popular Members
	</div>
	<div class="flip-card">
		<?php for($i=11;$i<20;$i++)
		echo '<img src="http://localhost/live_apps/feedstack/img/users/'.$i.'.png" class="flip_img"/>';
		?>
	</div>
	<div class="flip-footer">
	<a href="#">view all >></a>
	</div>
	</div>
	


</div>
</div>
<div class="clear"></div>
