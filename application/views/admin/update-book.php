

<!DOCTYPE html>
<html lang="en">

<head>

    <?php $baseLinkInsertCopy=base_url("index.php/admin/showInsertNewCopy"); 
        $baseLinkEditDetails=base_url("index.php/admin/showEditBookDetails");
        $baseLinkRemoveCopy=base_url("index.php/admin/showRemoveCopy");
    ?>

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

        /*var data=[{id:1,text:'1'},
                    {id:2,text:'2'},
                    {id:4,text:'4'},
                    {id:20,text:'5'},
                    {id:7,text:'7'}];*/
        
        var dataBooks=[<?php $first=1; ?>
            <?php foreach ($books as $row) {
                if(!$first)echo ",";
                echo "{id:$row->id,text:'$row->text'}";
                
                $first=0;
            } ?>];

        var selectedBookId;
        $(document).ready(function() { 
            $("#selectBook").select2({
                data:{
                     results: dataBooks
                }
            }); 

            $("#selectBook").change(function() {
                
                var theID = $("#selectBook").select2('data').id;
                var theSelection = $("#selectBook").select2('data').text;
                
                var fullSenetece="You have selected " + theSelection;
                selectedBookId=theID;
                $('#selectedText').text(fullSenetece);
                $("#update-form").css("visibility","visible");
                $("#options").css("visibility","visible");
                
                var link="<?php echo $baseLinkInsertCopy; ?>";
                link=link+"/"+$.trim(theSelection)+"/"+selectedBookId;
                $("#insertCopyLink").attr("href",link);

                link="<?php echo $baseLinkEditDetails; ?>";
                link=link+"/"+$.trim(theSelection)+"/"+selectedBookId;
                $("#editDetailsLink").attr("href",link);

                link="<?php echo $baseLinkRemoveCopy; ?>";
                link=link+"/"+$.trim(theSelection)+"/"+selectedBookId;
                $("#removeCopyLink").attr("href",link);
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userName; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url("index.php/login/logOut");  ?>">Log out</a>
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
                        <a href="<?php echo base_url('index.php/admin/lend') ?>">Lend Book</a>
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
                <input type="text" id="selectBook" class="row col-lg-4"><br><br>
                
                <h4 id="selectedText"></h4>

                <ul id="options" style="visibility:hidden;">
                    <li><a id="editDetailsLink"  href="">Change Book Details</a></li>
                    <li ><a id="insertCopyLink" href="" >Insert New Copy</a></li>
                    <li><a id="removeCopyLink" href="">Remove A Copy</a></li>
                </ul>
                
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
