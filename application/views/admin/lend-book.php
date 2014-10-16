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
    <link href="<?php echo base_url("assets/css/admin/lend.css"); ?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/css/select2.css"); ?>" rel="stylesheet"/>
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>
    <script>
        $(document).ready(function() { 
            $("#User-selector").select2({
                data:[
                    {id:0,text:"Rakin"},
                    {id:1,text:"Shohan"},
                    {id:2,text:"Tanzeer"},
                    {id:3,text:"Touhid"},
                    {id:4,text:"Shamim"}
                    ]
            }); 

            $("#User-selector").change(function() {
                //var theID = $(test).val(); // works
                //var theSelection = $(test).filter(':selected').text(); // doesn't work
                var theID = $("#selected-text").select2('data').id;
                var theSelection = $("#selected-text").select2('data').text;
                
                var fullSenetece="You have selected " + theSelection;
                $('#user-details').css('visibility','visible');
            });

            $("#book-selector").select2({
                data:[
                    {id:0,text:"Sherlock Homes"},
                    {id:1,text:"Harry Potter"},
                    {id:2,text:"3 Mistakes Of Life"},
                    {id:3,text:"Touhid"},
                    {id:4,text:"Shamim"}
                    ]
            }); 

            $("#book-selector").change(function() {
                //var theID = $(test).val(); // works
                //var theSelection = $(test).filter(':selected').text(); // doesn't work
                var theID = $("#selected-text").select2('data').id;
                var theSelection = $("#selected-text").select2('data').text;
                
                var fullSenetece="You have selected " + theSelection;
                $('#book-details').css('visibility','visible');

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
                    <li>
                        <a href="<?php echo base_url('index.php/admin/update') ?>">Update Book Information</a>
                    </li>
                    <li class="active">
                        <a href="<?php echo base_url('index.php/lend') ?>">Lend Book</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/fine') ?>"> Manage fines.</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/catalogue') ?>"> View Catalogue.</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style="  margin: 10px;padding: 10px;color: #428bca;">
                            Lend Book 
                        </h1>
                        <ol class="breadcrumb" id="breadcrumbdiv">
                            <li class="active">
                                Lend Requested Book
                            </li>
                        </ol>
                    </div>
                </div>

        <div id="book" >
            <label >Select a book</label>
            <input  type="text" id="book-selector" class="form-control">

            <center>

                <div style="visibility:hidden;" id="book-details" style="padding-top:20px">
                    <p>Name:Sherlock Homes<br>
                        Author:Sir Aurthur Conan Doyel<br>
                        Publisher:London Books<br>
                        Edition:1<br>
                        Copies Available:5<br>

                    </p>
                </div>
            </center>

        </div>

        <div id="user">
            <label >Select an user</label>
            <input type="text" id="User-selector" class="form-control">
            <center>

                <div style="visibility:hidden;" id="user-details" style="padding-top:20px">
                    <p>Name:Rakin<br>
                        Borrowed Books:2<br>
                    </p>
                </div>
            </center>
        </div>
        
        <center>
            <button id="lendButton"class="btn btn-success">Lend Book</button>
        </center>

    </div>

    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
