

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/admin/admin.css"); ?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/css/select2.css"); ?>" rel="stylesheet"/>
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>
    <script>
        $(document).ready(function() { 
            $('books').each(function(index){
                $("#selected-text").ad
            });
            $("#selected-text").select2({
                data:{ results: data, text: 'tag' },
                formatSelection: format,
                formatResult: format
            }); 

            $("#selected-text").change(function() {
                //var theID = $(test).val(); // works
                //var theSelection = $(test).filter(':selected').text(); // doesn't work
                var theID = $("#selected-text").select2('data').id;
                var theSelection = $("#selected-text").select2('data').text;
                
                var fullSenetece="You have selected " + theSelection;
                $('#selectedText').text(fullSenetece);
                $("#update-form").css("visibility","visible");
            });
        });
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img id="icon-image" style="height:100%" src="<?php echo base_url("assets/bookmark_icon.png"); ?>">Bookmark</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                	<a href="#">Home</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rakin<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Log out</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li >
                        <a href="<?php echo base_url('index.php/admin') ?>"> Dashboard</a>
                    </li>
                    <li >
                        <a href="<?php echo base_url('index.php/admin/insert') ?>">Insert New Book</a>
                    </li>
                    <li class="active">
                        <a href="<?php echo base_url('index.php/admin/update') ?>">Update Book Information</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/lend') ?>">Lend Book</a>
                    </li>
                    <li >
                        <a href="<?php echo base_url('index.php/admin/fine') ?>"> Manage fines.</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/catalogue') ?>"> View Catalogue.</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="height:100vh">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style=" margin: 10px;
                                                padding: 10px;
                                                color: #428bca;">
                            Update Books Information 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                Commit changes to your library.
                            </li>
                        </ol>
                    </div>
                </div>

                <label>Select a book</label><br>
                <input type="text" id="selected-text" class="row col-lg-4"><br><br>
                <label id="selectedText"></label>


                


                <form class="well" role="form">
                    <label >Name:</label><br>
                    <input type="text" class="form-control" ><br>
                    <label>Author:</label><br>
                    <input type="text" class="form-control"><br>
                    <label>Publisher:</label><br>
                    <input type="text" class="form-control"><br>
                    <label>Edition:</label><br>
                    <input type="text" class="form-control"><br>
                    <label>No. of Copies</label><br>
                    <input type="text" class="form-control"><br>
                    <input type="submit" class="btn btn-primary" value="Update">
                </form>

                
            </div>
            <!-- /.container-fluid -->

            
        </div>


    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>