<?php
	$route = kite::route('interface/routing/push');
?>
<form role="form" action ="<?php echo ROOT.$route; ?>" method="post">
<div id="flip-head" >
<div class="bcol-15">
<div class="header_image">
<i class="fa fa-truck fa-5x"></i>
</div>
</div>
<div class="bcol-85">
<h1>Add Route
<button type="submit" class="btn btn-big strong pull-right"><i class='fa fa-save' ></i>&nbsp; save</button>
</h1>

<p>
Update the framework settings stored in config.json file with this interface.

</p>
</div>
<div class="clear"></div>
<div class="strip grey"></div>
</div>



<div class="well">
  <h3>Route Details</h3>
  <div >
    <div class="bcol-40 strong">Route</div>
    <div class="bcol-60">
	<input type="text"  class="w100" name="route" placeholder="Enter the relative route">
	<br><small>eg: math/add/3</small>

	</div>
	<div class="clear"></div>
  </div>
   <div >
    <div class="bcol-40 strong">Default</div>
    <div class="bcol-60">
		<select class="w100" name="DEFAULT">
			<option value="yes" >Yes</option>
			<option value="no">No</option>
		</select>	
	</div>
	<div class="clear"></div>
  </div>
 </div> 
 
 <div class="strip green"></div>
  <div class="well">
  <h3> Application Details</h3>

   <div >
		<div class="bcol-40 strong">&nbsp;</div>
		<div class="bcol-60"><small>Leave the feilds empty if they are not used.</small><br></div>
		<div class="clear"></div>
  </div>
  
    <div >
		<div class="bcol-40 strong">Application</div>
		<div class="bcol-60"><input type="text"  class="w100" name="APP_APPLICATION"placeholder="Application name"></div>
		<div class="clear"></div>
  </div>
  
  <div >
		<div class="bcol-40 strong">Controller</div>
		<div class="bcol-60"><input type="text"  class="w100" name="APP_CONTROLLER"placeholder="Controller name"></div>
		<div class="clear"></div>
  </div>
  
  <div >
		<div class="bcol-40 strong">Method</div>
		<div class="bcol-60"><input type="text"  class="w100" name="APP_METHOD"placeholder="Method name"></div>
		<div class="clear"></div>
  </div>
    <div >
		<div class="bcol-40 strong">Options</div>
		<div class="bcol-60"><input type="text"  class="w100" name="OPTIONS"placeholder="/x/y/z"></div>
		<div class="clear"></div>
  </div>
      <div >
		<div class="bcol-40 strong">Paramters</div>
		<?php $a= "a=sample&b=another"; ?>
		<div class="bcol-60"><input type="text"  class="w100" name="PARAMS" placeholder="<?php echo $a; ?>"></div>
		<div class="clear"></div>
  </div>

</div>

<div class="strip green"></div>
<div class="well">
<h3> Template Details</h3>

   <div >
		<div class="bcol-40 strong">&nbsp;</div>
		<div class="bcol-60"><small>Leave the feilds empty if they are not used.</small><br></div>
		<div class="clear"></div>
  </div>
  
    <div >
		<div class="bcol-40 strong">Theme</div>
		<div class="bcol-60"><input type="text"  class="w100" name="THEME_R"placeholder="Theme name"></div>
		<div class="clear"></div>
  </div>

    <div >
		<div class="bcol-40 strong">Layout</div>
		<div class="bcol-60"><input type="text"  class="w100" name="LAYOUT_R"placeholder="Layout name"></div>
		<div class="clear"></div>
  </div>
</div>
   
<div class="strip green"></div>
<div class="well">
  <h3> META Information</h3>
     <div >
		<div class="bcol-40 strong">&nbsp;</div>
		<div class="bcol-60"><small>Leave the feilds empty if they are not used.</small><br></div>
		<div class="clear"></div>
  </div>
  
     <div >
		<div class="bcol-40 strong">Title</div>
		<div class="bcol-60"><input type="text"  class="w100" name="META_TITLE"placeholder="Page Title"></div>
		<div class="clear"></div>
  </div>

     <div >
		<div class="bcol-40 strong">Author</div>
		<div class="bcol-60"><input type="text"  class="w100" name="META_AUTHOR"placeholder="Author Name"></div>
		<div class="clear"></div>
  </div>
   
     <div >
		<div class="bcol-40 strong">Description</div>
		<div class="bcol-60"><textarea class="w100" name="META_DESC" placeholder="Page Description" rows="3"></textarea></div>
		<div class="clear"></div>
  </div>

    <div >
		<div class="bcol-40 strong">Keywords</div>
		<div class="bcol-60"><input type="text"  class="w100" name="META_KEYWORDS"placeholder="Keywords"></div>
		
		<div class="clear"></div>
  </div>
</div>

<input type="hidden"  class="w100" name="action" value="created">
</form>