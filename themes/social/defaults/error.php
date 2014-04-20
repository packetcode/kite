<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico">
<title>Opps ! Something went wrong</title>
<LINK href="<?php echo ROOT.'themes/interface/css/error.css'; ?>" rel="stylesheet" type="text/css">
</head>
 <body>
<div class="error">
<div class="oops">&lt;/></div>
<p class="wrong">OOPS ! Something went wrong</p>
	<div class="card-top">Error Message</div>
	<div class="card">
	<?php Error::show() ?>
	</div>
</div>
</body>
</html>