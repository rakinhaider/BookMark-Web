<html>
<head>
	<title>
	</title>
	<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
</head>
<body>
	<div id="container">
		<h1>Super </h1>
		<?php echo $this->table->generate($books) ?>
		<?php echo $this->pagination->create_links(); ?>
	</div>
</body>
</html>