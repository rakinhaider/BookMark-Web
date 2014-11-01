
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
		  			<li ><a href="<?php echo base_url(); ?>index.php/home/userManual"><span class="glyphicon glyphicon-question-sign"></span></a></li>
		  	</ul>
		</div>
	</nav>


	<div style="margin-left:50px;margin-right:50px;margin-top:20px;">
		<div class="alert alert-success" role="alert" ><h2>User Manual</h2></div>

		<div class="panel panel-primary">
		  	<div class="panel-heading">Admin Section</div>
		 	<div class="panel-body">
		    	<div class="panel panel-info">
				  	<div class="panel-heading">Insert Books</div>
				 	<div class="panel-body">
				    	<p>A librarian can insert books, authors and publishers using responsive forms.</p>
				 	</div>
				</div>
				<div class="panel panel-info">
				  	<div class="panel-heading">Update Books</div>
				 	<div class="panel-body">
				    	<p>A librarian can update existing informations of a book, remove existing copies or insert new copies for a book as well as insert new edition informations.</p>
				 	</div>
				</div>
				<div class="panel panel-info">
				  	<div class="panel-heading">Manage Fine</div>
				 	<div class="panel-body">
				    	<p>A table built to show fines of every users. A librarian can clear dues fully or reduce a partial amount according to payment.</p>
				 	</div>
				</div>
				<div class="panel panel-info">
				  	<div class="panel-heading">Catalogue</div>
				 	<div class="panel-body">
				    	<p>A responsive catalogue is provided to the librarian to search and view book details.Searching can be done by category,publisher,title and even by simple text.</p>
				 	</div>
				</div>
		 	</div>
		</div>
		<div class="panel panel-danger">
		  	<div class="panel-heading">User Section</div>
		 	<div class="panel-body">
		 		<div class="panel panel-warning">
				  	<div class="panel-heading">Personal Information</div>
				 	<div class="panel-body">
				    	<p>An user can change his personal information if required.</p>
				 	</div>
				</div>
		 		<div class="panel panel-warning">
				  	<div class="panel-heading">Borrow List</div>
				 	<div class="panel-body">
				    	<p>An user can view the list of books borrowed by him, deabline of returning books.</p>
				 	</div>
				</div>
		    	<div class="panel panel-warning">
				  	<div class="panel-heading">Catalogue</div>
				 	<div class="panel-body">
				    	<p>A responsive catalogue is provided to the librarian to search and view book details.Searching can be done by category,publisher,title and even by simple text.</p>
				 	</div>
				</div>
		 	</div>
		</div>
	</div>
	
</body>



</html>