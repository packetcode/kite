
<?php $basket = kite::getInstance('basket'); 
			$error = $basket->get('msg');
			if($error !=null)
				echo "<div class='alert status green'> ".$error."</div>";
			$route = kite::route('interface/root/login');	
?>

<h4>Administrator Access</h4>
<p> Please enter the Secure hash to access the kite administrator  interface</p>
<form  action="<?php echo ROOT.$route; ?>" method="post">
<div class="">
    <input type="password" class="w100" name="hash" placeholder="Enter hash code">
  </div>
    <button type="submit" class="btn btn-lg login-btn">Submit</button>
	<br>
</form>
