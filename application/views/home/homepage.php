
<?php $this->load->helper('url'); ?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/custom.js"); ?>"></script>
	
	<script type="text/javascript" src="<?php echo base_url("assets/js/carousel.js"); ?>"></script>
</head>

<body>

	

	<nav class="navbar navbar-inverse" style="margin-bottom:0px;">
		<div class="container">
			<div class="navbar-header">
				
				<a class="navbar-brand" href="#">
					<img 
					src="<?php echo base_url("assets/bookmark_icon.png"); ?> " 
					style="height:100%;">Bookmark
				</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				
		  			<li ><a href="<?php echo base_url(); ?>index.php/home">Home</a></li>
		  			<li ><a style="cursor:pointer;" id="loginpopup">Log In</a></li>
		  			<li ><a id="signup_popup">Register</a></li>
		  			<li ><a href="#"><span class="glyphicon glyphicon-question-sign"></span></a></li>
		  	</ul>
		</div>
	</nav>


	<div id="carousel-example-generic" 
		class="carousel slide" 
		data-ride="carousel" data-ride="carousel" >
					  <!-- Indicators -->
		<ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>  
	
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <div id="0" class="item active">
	      	<img src="<?php echo base_url("assets/Library.png"); ?>" alt="First Image">
	      	<div class="carousel-caption">
	        	Manage Your Library
	      	</div>
	    </div>
	    
	    <div id="1" class="item">
	      	<img src="<?php echo base_url("assets/Library6.png"); ?>" alt="Second Image">
	      	<div class="carousel-caption">
	        	Keep Records
	     	</div>
	    </div>
	    
	    <div id="2" class="item">
	      	<img src="<?php echo base_url("assets/Library3.png"); ?>" alt="Third Image">
	      	<div class="carousel-caption">
	        	Access A Library Online
	      	</div>
	    </div>
	</div>
	
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>


	<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	  <div class="modal-dialog " style="margin-top: 150px;padding:100px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalTitle">Register to get access</h4>
	      </div>
	      <form method="post" action="<?php echo base_url("index.php/register/validate"); ?>">
	      		<div class="modal-body" id="login_details">
		        	<div class="row-fluid">
		        		<div class="span2">
		        			<label>First Name:</label><br>
		        			<input type="text"  name="first_name"><br>
		        			<label>Last Name:</label><br>
		        			<input type="text"  name="last_name"><br>
		        			<label>Email Address</label><br>
		        			<input type="text" name="email_address"><br>
		        			<label>Password</label><br>
		        			<input type="password" name="password"><br>
		        			<label>Confirm Password</label><br>
		        			<input type="password" name="confirm_password"><br>

		    	        </div>
		        		
		        		<div class="span2">
		        			<label>Occupation</label><br>
		        			<input type="text" name="occupation"><br>
		        			<label>Gender</label><br>
							<input type="radio" name="sex" value="male">Male
							<input type="radio" name="sex" value="female">Female<br>
		        			<label>Address</label><br>
		        			<input type="password" name="address"><br>

		        		</div>
		        	</div>
		      	</div>
		      	<div class="modal-footer" >
					<input style="float: left" type="submit" class="btn btn-success" value="Sign Up" /> 
	       			</br></br>
		        </div>
	      </form>
	      
	    </div>
	  </div>
	</div>



	<div class="modal fade in" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	  <div class="modal-dialog " style="margin-top: 150px;max-width:300px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel1">Login to Landing</h4>
	      </div>
	      <form method="post" action="<?php echo base_url("index.php/login/validate"); ?>">
		      <div class="modal-body" id="login_details">
		        <span> Already have an account? </span> </br></br>
		        *<span style="font-weight:bold;">Your Email</span><br />
		        <input type="text" placeholder="example@gmail.com" name="login_email" /><br /></br>
		        *<span style="font-weight:bold;" >Password</span><br />
		        <input type="password" placeholder="Password" name="login_password" /><br />
		      </div>
		      <div class="modal-footer" >
				<input style="float: left" type="submit" class="btn btn-success" value="Log In" /> 
		       <span class="fp-link"> <a href="#">Forgot Password?</a></span>
		       </br></br>
				<span> Not a member yet?</span>
				<span id="signup-link" style="cursor:pointer;" class="text-info">Sign Up!</span>
		      </div>
			</form>
	    </div>
	  </div>
	</div>

	
</body>



</html>