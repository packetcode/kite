
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php Kite::getSite('desc'); ?>">
    <meta name="author" content="<?php Kite::getSite('author'); ?>">
	 <meta name="keywords" content="<?php Kite::getSite('keywords'); ?>">
    <link rel="shortcut icon" href="favicon.ico">
    <title><?php Kite::getSite('title'); ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo ROOT.'themes'.DS.'bottle'.DS.'bootstrap.css'; ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo ROOT.'themes'.DS.'bottle'.DS.'style.css';?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background:#F8F8F8 ">
  
    <div class="container" style="background:white;padding:20px">
	<!-- Header-->
      <div class="header">
		<div class="pull-right">
			<?php Kite::snippet('menu'); ?>
		</div> 
        <h3 class="text-muted"><b>SIMPLE - MATH</b></h3>
      </div>
	  <!-- Application -->
	  <div >
		<?php KITE::app(); ?>
	  </div>	
	  <!-- Footer -->
      <div class="footer">
		<?php Kite::snippet('footer'); ?>
      </div>
    </div> <!-- /container -->

  </body>
</html>
