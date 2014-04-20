<?php $session= kite::getInstance('session'); 
		$user = $session->get('user');
		$image = $user->image;
		
		$option=array("username"=>"shaadomanthra");
		$data = kite::connect('user','getname',$option);
		var_Dump($data);
		if(isset($data->DATA->NAME))
			echo $data->DATA->NAME;
		$user1 = kite::getInstance('user');
		//echo $user1->get('id');
	?>	
<div class="loggedin_wrap">	
<img src="<?php echo $image; ?>" width="100%"/>
<div class="loggedin">
		<div class="loggedin_name"><b><?php echo ucfirst($user->name) ?></b> 
		<a href="<?php echo ROOT.kite::route('user/core/logout'); ?>" class="btn logout_in">Logout</a>
		</div>
		
</div>
<div>
<?php 
?>

