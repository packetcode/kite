<?php
	$route = kite::route('interface/configuration');
	$basket = kite::getInstance('basket');
	$status = $basket->get('status');
	if($status != null)
		echo "<div class='well green status'>".$status."</div>";
?>
<form role="form" action ="<?php echo ROOT.$route; ?>" method="post">
<div id="flip-head" >
<div class="bcol-15">
<div class="header_image">
<i class="fa fa-gear fa-5x"></i>
</div>
</div>
<div class="bcol-85">
<h1>Configuration
<button type="submit" class="btn btn-big strong pull-right"><i class='fa fa-edit' ></i> update</button>
</h1>
<p>
The below are the Framework configuration data stored in config.json in root folder 
</p>

</div>

<div class="clear"></div>
<div class="strip grey"></div>
</div>
 <div class="well">
  <h3> General Settings </h3>
  <p>The following are the basic settings used in the framework</p>
  <div >
		<div class="bcol-40 strong">Secure</div>
		<div class="bcol-60">
			<select name="SECURE" class="w100" >
				<option value='0'<?php if($basket->get('SECURE')=='0') echo 'selected'; ?>>0</option>
				<option value='1' <?php if($basket->get('SECURE')=='1') echo 'selected'; ?> >1</option>
			</select>
			<small>By setting it to '0' will make the access to json/html view public and when set to '1' 
				makes the access secured i.e. accessible by suffixing url with hash</small>
		</div>
		<div class="clear"></div>
  </div>


    <div >
		<div class="bcol-40 strong">Hash</div>
		<div class="bcol-60"><input type="text"  class="w100" name="HASH"  value ="<?php echo $basket->get('HASH'); ?>" ><br>
		<small>This hash is used for secure json/html access</small></div>
		<div class="clear"></div>
  </div>

 <div >
		<div class="bcol-40 strong">Secure Hash</div>
		<div class="bcol-60"><input type="password"  class="w100" name="SHASH"  value ="empty" ><br>
		<small> This is the administrator password</small></div>
		<div class="clear"></div>
  </div>

    <div >
		<div class="bcol-40 strong">Session Expire</div>
		<div class="bcol-60"><input type="text"  class="w100" name="SESSION_EXPIRE"  value ="<?php echo $basket->get('SESSION_EXPIRE'); ?>" ><br>
			<small>Mention the time lapse in seconds after which the session will be expired</small>
		</div>
		<div class="clear"></div>
  </div>

</div>


<div class="strip grey"></div>
 <div class="well">
  <h3>Server Database Settings</h3>
  <p>The default settings for database, used when deployed on server i.e. URL other than 'localhost'</p>
  <div >
		<div class="bcol-40 strong">DB Name</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_NAME"  value ="<?php echo $basket->get('DB_NAME'); ?>" ><br></div>
		<div class="clear"></div>
  </div>
  
  <div >
		<div class="bcol-40 strong">Host</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_HOST"  value ="<?php echo $basket->get('DB_HOST'); ?>" ><br><small> usually localhost</small></div>
		<div class="clear"></div>
  </div>

    <div >
		<div class="bcol-40 strong">Username</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_USERNAME"  value ="<?php echo $basket->get('DB_USERNAME'); ?>" ><br></div>
		<div class="clear"></div>
  </div>

 <div >
		<div class="bcol-40 strong">Password</div>
		<div class="bcol-60"><input type="password"  class="w100" name="DB_PASSWORD"  value ="<?php echo $basket->get('DB_PASSWORD'); ?>" ><br></div>
		<div class="clear"></div>
  </div>

  <div >
		<div class="bcol-40 strong">DB Prefix</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_PREFIX"  value ="<?php echo $basket->get('DB_PREFIX'); ?>" ><br></div>
		<div class="clear"></div>
  </div>
  
</div>
 

<div class="strip grey"></div>
 <div class="well">
  <h3>Local Database Settings</h3>
   <p>This database settings are used for local server 'localhost' by overridding the default database settings</p>
  <div >
		<div class="bcol-40 strong">DB Name</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_LOCAL_NAME"  value ="<?php echo $basket->get('DB_LOCAL_NAME'); ?>" ><br></div>
		<div class="clear"></div>
  </div>
  
  <div >
		<div class="bcol-40 strong">Host</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_LOCAL_HOST"  value ="<?php echo $basket->get('DB_LOCAL_HOST'); ?>" ><br><small> usually localhost</small></div>
		<div class="clear"></div>
  </div>

    <div >
		<div class="bcol-40 strong">Username</div>
		<div class="bcol-60"><input type="text"  class="w100" name="DB_LOCAL_USERNAME"  value ="<?php echo $basket->get('DB_LOCAL_USERNAME'); ?>" ><br></div>
		<div class="clear"></div>
  </div>

 <div >
		<div class="bcol-40 strong">Password</div>
		<div class="bcol-60"><input type="password"  class="w100" name="DB_LOCAL_PASSWORD"  value ="<?php echo $basket->get('DB_LOCAL_PASSWORD'); ?>" ><br></div>
		<div class="clear"></div>
  </div>	
</div>
<input type="hidden"  class="w100" name="VERSION"  value ="<?php echo $basket->get('VERSION'); ?>" >
<input type="hidden"  class="w100" name="INSTALLATION"  value ="<?php echo $basket->get('INSTALLATION'); ?>" >
<input type="hidden"  class="w100" name="TASK"  value ="push" >

 </form>

 <script>
 $(function(){
 	
 });
 </script>