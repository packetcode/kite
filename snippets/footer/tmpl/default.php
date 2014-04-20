<?php $packet = kite::getInstance('packet')->get('params'); ?>
<style>
	ul.footer-menu{
		padding:0px;
		margin:0px;
		list-style: inline;

	}
	ul.footer-menu li{
		list-style-type: none;
		display:inline;
		padding-right:10px;
	}
	.pull-right{
		float:right;
		padding-top:10px;
	}
	.social{
		color:#cbd0d3;
	}
	.social:hover{
		color:#7f8c8d;
	}
</style>		
<div class="kite-editable"> 
	<div class="pull-right">
		<a href="https://www.facebook.com/groups/packetcode/"><i class="fa fa-facebook-square social fa-2x"></i></a>&nbsp;
		<a href="https://twitter.com/shaadomanthra"><i class="fa fa-twitter-square social fa-2x"></i></a>&nbsp;
		<a href="https://github.com/packetcode"><i class="fa fa-github fa-2x social"></i></a>&nbsp;
	</div>
		<div> <small>
		<ul class="footer-menu">	
			<a href=""><li>Home</li></a>
			<li>About </li>
			<li>Terms</li>
			<li>Licence</li>
			<li>Feedback</li>
		</ul></small>
	<small><?php echo $packet->COPYRIGHT.' '.$packet->LINK; ?></small>

	</div>

</div>	