
<div style="background:#E8E8E8;">
<div style="background:white;padding-top:20px">
<div class="container" >
	<div style="padding-top:20px;text-align:center">
	<img src="img/kite_logo.png" />
	<div class="well" >
	<h2> Installation Wizard</h2>
	KITE is a nano php framework to build applications with ease. 
	It has inbuilt url routing with support for multiple app development environment, 
	render views in html or json or with template, inbuilt installer and database abstraction layer.</div>
	</div>
</div>	
</div>	

	<form class="form-horizontal " role="form" action="" method="post">
	<div style="padding:20px">
	
	<div class="container">
	<div class="row" style="background:white;padding-top:20px">
	<div class="col-md-5">
	<div class="well well-sm">
	<p><b>General Information</b><br>
	This information is used in the template meta tags. That are used by search engines to understand the page content
	</p>
	</div>
	</div>
	<div class="col-md-7">

	<div class="form-group">
    <label class="col-lg-3 control-label">Site Name</label>
    <div class="col-lg-9">
      <input class="form-control"name="title" type="text" placeholder="Enter the desired site name" >
    </div>
  </div>
      <div class="form-group">
    <label class="col-lg-3 control-label">Description</label>
    <div class="col-lg-9">
      <input class="form-control"name="desc" type="text" placeholder="Enter site description" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-3 control-label">Author</label>
    <div class="col-lg-9">
      <input class="form-control"name="author" type="text" placeholder="Enter your name" >
    </div>
  </div>
      <div class="form-group">
    <label class="col-lg-3 control-label">Keywords</label>
    <div class="col-lg-9">
      <input class="form-control"name="keywords" type="text" placeholder="Enter Keywords seperated by commas" >
    </div>
  </div>
  

  
	</div>
	</div>

	<br>
	<div class="row" style="background:white;padding-top:20px">
	<div class="col-md-5">
  	<div class="well well-sm">
	<b>Database Setup</b><br>
	Setting up a database to store the data in MySql. For security tables are prefixed with random string.
	</div>
	</div>
		<div class="col-md-7">
	<div class="form-group">
    <label class="col-lg-3 control-label">DB Type</label>
    <div class="col-lg-9">
      <input class="form-control" id="disabledInput" type="text" placeholder="MySQL" disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-lg-3 control-label">Host</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="host" placeholder="hostname">
	   <span class="help-block">This is usually 'localhost'</span>
    </div>
  </div>
  <div class="form-group">
    <label  class="col-lg-3 control-label">DB Name</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="db_name" placeholder="Enter the Database name">
    </div>
  </div>
 <div class="form-group">
    <label class="col-lg-3 control-label">root user</label>
    <div class="col-lg-9">
      <input type="text" class="form-control" name="username" placeholder="username">
	  <span class="help-block">This is usually 'root' or a username given by host</span>
    </div>
  </div>
   <div class="form-group">
    <label class="col-lg-3 control-label">password</label>
    <div class="col-lg-9">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
  <label class="col-lg-3 control-label">&nbsp;</label>
    <div class=" col-lg-9">
      <button type="submit" class="btn btn-primary">Install</button>
    </div>
  </div>
	</div>
</div>
</div>
</div>
</form>
<div style="background:white;padding-top:20px">
      <div class="footer">
	  <br>
	  <div class="text-muted text-center">
        <small >KITE FRAMEWORK @ www.packetcode.com</small>
		</div>	
		<br>
      </div>
</div>  
</div>

