<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">

    <?php $copyCount=1; ?>
    <?php $categoryId=$bookDetails->category; ?>
    <?php $toSet=''; 
    foreach ($categories as $row ) {
        if($row->id==$categoryId)
        {
            $toSet=$row->text;
        }
    } ?>  
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/css/select2.css"); ?>" rel="stylesheet"/>
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>
    <script type="text/javascript">
   /* var custom_array = [<?php $first=1; ?>
            <?php foreach ($authors as $row) {
                if(!$first)echo ",";
                echo "'$row->text'";
                
                $first=0;
            } ?>];*/
        var dataAuthor=[<?php $first=1; ?>
        <?php foreach ($authors as $row) {
            if(!$first)echo ",";
            echo "{id:$row->id,text:'$row->text'}";
            
            $first=0;
        } ?>];
        var defaultAuthor=[<?php $first=0;
        foreach ($written_by as $row ) {
            if($first!=0)echo ",";
            echo '"'.$row->author_id.'"';
            $first=1;
        }
         ?>];
        var dataPublisher=[<?php $first=1; ?>
        <?php foreach ($publishers as $row) {
            if(!$first)echo ",";
            echo "{id:$row->id,text:'$row->text'}";
            
            $first=0;
        } ?>];

        var dataCategory=[<?php $first=1; ?>
        <?php foreach ($categories as $row) {
            if(!$first)echo ",";
            echo "{id:$row->id,text:'$row->text'}";
            
            $first=0;
        } ?>];

        var authorCount=0;
        
        var divNewPublisher="<label>Name</label>"+
                            "<input name=\"pName\" type=\"text\" class=\"form-control\"><br>"+
                            "<label>Address</label>"+
                            "<input name=\"pAddress\" type=\"text\" class=\"form-control\"><br>"+
                            "<label>Contact</label>"+
                            "<input name=\"pContact\" type=\"text\" class=\"form-control\"><br>"+
                            "<label>Email Address</label>"+
                            "<input name=\"pEmail\" type=\"text\" class=\"form-control\"><br>"+
                            "<label>Website</label>"+
                            "<input name=\"pWeb\" type=\"text\" class=\"form-control\"><br>";

        $(document).ready(function() { 

            $("[name=bTitle]").attr("value","<?php echo $bookDetails->title; ?>");

            $("#selectedAuthor").select2({
                data:{
                     results: dataAuthor
                },
                multiple:true
            });
            $("#selectedAuthor").val(defaultAuthor).trigger("change");

            $("#selectCategory").select2({
                data:{
                    results:dataCategory
                }
            });
            $("#selectCategory").val("<?php echo $categoryId; ?>").trigger("change");
            $("#selectedPublisher").select2({
                data:{
                     results: dataPublisher
                },
            });
            $("#selectedPublisher").val("<?php echo $bookDetails->publisher_id; ?>").trigger("change");
            $("#btnAddNewAuthor").click(function(){
                authorCount=authorCount+1;
                var divNewAuthor="<div class=\"well\"><label>"+authorCount+".Name</label>"+
                            "<input name=\"aName"+authorCount+"\"type=\"text\" class=\"form-control\"><br>"+
                            "<label>"+authorCount+".Address</label>"+
                            "<input name=\"aAddress"+authorCount+"\"type=\"text\" class=\"form-control\"><br>"+
                            "<label>"+authorCount+".Contact</label>"+
                            "<input name=\"aContact"+authorCount+"\"type=\"text\" class=\"form-control\"><br>"+
                            "<label>"+authorCount+".Email Address</label>"+
                            "<input name=\"aEmail"+authorCount+"\" type=\"text\" class=\"form-control\"><br>"+
                            "<label>"+authorCount+".Website</label>"+
                            "<input name=\"aWeb"+authorCount+"\" type=\"text\" class=\"form-control\"><br></div>";
                $("#divNewAuthor").append(divNewAuthor);
                $("#newAuthorCount").attr("value",authorCount);

            });
            $("#btnAddNewPublisher").click(function(){
                var btnName=$("#btnAddNewPublisher").attr("value");
                if(btnName=="Add New Publisher"){
                    $("#divNewPublisher").html(divNewPublisher);
                    $("#divSelectorPublisher").fadeToggle( "slow", "linear" );
                    $("#btnAddNewPublisher").attr("value","Back To Selection");
                }
                else if(btnName=="Back To Selection")
                {
                    $("#divNewPublisher").html("");
                    $("#divSelectorPublisher").fadeToggle( "slow", "linear" );
                    $("#btnAddNewPublisher").attr("value","Add New Publisher");
                }
            });
            $("#selectedAuthor").change(function() {
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

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/admin/admin.css"); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/autosuggest.css"); ?>"></link>
    
    <script type="text/javascript" src="<?php echo base_url("assets/js/autosuggest.js"); ?>"></script>


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
                    <li class="active">
                        <a href="<?php echo base_url('index.php/admin/insert') ?>">Insert New Book</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/update') ?>">Update Book Information</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/lend') ?>">Lend Book</a>
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

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style=" margin: 10px;
                                                padding: 10px;
                                                color: #428bca;">
                            Edit Book Details
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Change informations you want.
                            </li>
                        </ol>
                    </div>
                </div>

                <div >
                    <form role="form" method="POST" action="<?php echo base_url('index.php/admin/editBookDetails') ?>">
                        <input name="book_id" type="hidden" class="form-control" value="<?php echo $bookDetails->book_id; ?>"><br>
                        <label >Name:</label><br>
                        <input name="bTitle" type="text" class="form-control"><br>
                        <label >Category:</label><br>
                        <input name="bCategory" type="text" id="selectCategory" class="row col-lg-4"><br><br>
                        
                        <div class="well">
                            <h3>Author</h3>
                            <div id="divSelectorAuthor">
                                <label>Select Author</label><br>
                                <input name="selectedAuthor" type="text" id="selectedAuthor" class="row col-lg-4"><br><br>
                                <label>Or</label>
                            </div>
                            <input id="btnAddNewAuthor" type="button"  class="btn btn-primary" role="button" value="Add New Author">
                            <input name="newAuthorCount" type="hidden" value="" id="newAuthorCount">
                            <br>
                            <div id="divNewAuthor"></div>
                        </div>


     
                        <div class="well">
                            <h3>Publisher</h3>
                            <div id="divSelectorPublisher">
                                <label>Select Publisher</label><br>
                                <input name="selectedPublisher" type="text" id="selectedPublisher" class="row col-lg-4"><br><br>
                                <label>Or</label>
                            </div>
                            <input id="btnAddNewPublisher" type="button"  class="btn btn-primary" role="button" value="Add New Publisher">
                            <br>
                            <div id="divNewPublisher"></div>
                        </div>
                        <input type="submit" class="btn btn-success" value="Submit">
                    </form>
                </div> 
                    


            </div>
            <!-- /.container-fluid -->

        </div>


    </div>
    <!-- /#wrapper -->



    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
