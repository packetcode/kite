<style>
.separator{
	color:#C8C8C8 ;
}
.pad-top{
	padding-top:7px;
}
.pull-right{
	float:right;
}
</style>
<div>
<?php 
			$node = kite::getInstance('node'); 


			if($node->get('n1'))
			{
				if(!isset($node->N2))
				echo "Welcome <b>Administrator</b>";
				else
				echo "<a href='".ROOT.$node->N1.DS."'>".ucfirst('home')." </a>";
			}
			if(isset($node->N2))
			echo "<span class='separator' >/</span> <a href='".ROOT.$node->N1.DS.$node->N2."'>".ucfirst($node->N2)."</a> ";
			if(isset($node->N3))
			echo "<span class='separator' >/</span> <a href='".ROOT.$node->N1.DS.$node->N2.DS.$node->N3."'>".ucfirst($node->N3)."</a> ";
			if(isset($node->N4))
			echo "<span class='separator' >/</span> <a href='".ROOT.$node->N1.DS.$node->N2.DS.$node->N3.DS.$node->N4."'>".ucfirst($node->N4)."</a> ";
			
?>
</div>