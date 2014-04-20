<?php
	$basket = kite::getInstance('basket');
	$error = $basket->get('error');
	$forgot = kite::route('user/core/forgot');
	$register = kite::route('user/core/register');
	


?>
<div class="login_container">
<?php if($error) { ?>
	<div class="alert"><?php echo $error; ?></div>
<?php } ?>	
	<div class="login_logo">
		<?php kite::snippet('logo'); ?>
	</div>
	<div class="login_form">
		<form action="" method="post">
		<input type="text" class="login_input" name="username" placeholder="username" />
		<input type="password" class="login_input" name="password" placeholder="password" />
		<input type="submit" class="login_button" value="login" />
		</form>
		<div class="login_extra_details">
			<div class="ref_link"><a href="<?php echo ROOT.$forgot; ?>"><i class="fa fa-star-o light" ></i> Forgot Password?</a></div>
			<div class="ref_link"><a href="<?php echo ROOT.$register; ?>"><i class="fa fa-star-o light" ></i> Register for the site</a></div>
		</div>
	</div>
</div>