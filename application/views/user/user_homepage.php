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
    <link href="<?php echo base_url("assets/css/jquery-ui.css"); ?>" rel="stylesheet">
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery-ui.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>
    <script type="text/javascript">
        var divEdit="<form role=\"form\" method=\"POST\" action=\"<?php echo base_url('index.php/user/editInfo').'/'.$user_id.'/'.urlencode($userInfo->email_id); ?>\"><label class=\"col-lg-2\">First Name: </label><input id=\"first_name\" type=\"text\" name=\"first_name\" ><br>"+
                    "<label class=\"col-lg-2\">Last Name: </label><input id=\"last_name\" type=\"text\" name=\"last_name\" ><br>"+
                    "<label class=\"col-lg-2\">Email Address: </label><input id=\"email_id\" type=\"text\" name=\"email_id\" ><br>"+
                    "<label class=\"col-lg-2\">Address: </label><input id=\"address\" type=\"text\" name=\"address\" ><br>"+
                    "<label class=\"col-lg-2\">Occupation: </label><input id=\"occupation\" type=\"text\" name=\"occupation\" ><br>"+
                    "<label class=\"col-lg-2\">Nationality: </label><input id=\"nationality\" type=\"text\" name=\"nationality\" ><br>"+
                    "<label class=\"col-lg-2\">Date Of Birth: </label><input id=\"datePicker\"type=\"text\" name=\"date_of_birth\" ><br>"+
                    "<label class=\"col-lg-2\">Gender: </label><input class=\"col-lg-2\" id=\"genderSelector\" type=\"text\" name=\"gender\" ><br><input type=\"submit\" class=\"btn btn-success\" value=\"Submit\"></form>";
        

        $(document).ready(function() { 
            
            $("#divEdit").fadeToggle( "slow", "linear" ); 
            $("#editButton").click(function(){
                var val=$(this).text();
                if(val=="Edit Info")
                {
                    $("#divEdit").html(divEdit); 
                    $("#divEdit").fadeToggle( "slow", "linear" ); 
                    $("#divShow").fadeToggle( "slow", "linear" ); 
                    //$("#editButton").text("Submit");
                    //$("#editButton").attr("class","btn btn-primary");


                    $("#first_name").val("<?php echo $userInfo->first_name; ?>");
                    $("#last_name").val("<?php echo $userInfo->last_name; ?>");
                    $("#email_id").val("<?php echo $userInfo->email_id; ?>");
                    $("#email_id").attr('disabled','disabled');
                    $("#address").val("<?php echo $userInfo->address; ?>");
                    $("#occupation").val("<?php echo $userInfo->occupation; ?>");
                    $("#datePicker").datepicker();
                    $("#datePicker").val("<?php echo $userInfo->date_of_birth; ?>");
                    $("#genderSelector").select2({
                        data:[
                            {id:1,text:'Male'},
                            {id:2,text:'Female'},
                            
                        ]
                    });
                    var gender="<?php echo $userInfo->gender; ?>";
                    if(gender=="male")$("#genderSelector").val(1).trigger("change");
                    else $("#genderSelector").val(2).trigger("change");
                }
                
                // var btnName=$("#btnAddNewPublisher").attr("value");
                // if(btnName=="Add New Publisher"){
                //     $("#divNewPublisher").html(divNewPublisher);
                //     $("#divSelectorPublisher").fadeToggle( "slow", "linear" );
                //     $("#btnAddNewPublisher").attr("value","Back To Selection");
                // }
                // else if(btnName=="Back To Selection")
                // {
                //     $("#divNewPublisher").html("");
                //     $("#divSelectorPublisher").fadeToggle( "slow", "linear" );
                //     $("#btnAddNewPublisher").attr("value","Add New Publisher");
                // }
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
                <a class="navbar-brand" href="index.html"><img id="icon-image" style="height:100%;" src="<?php echo base_url("assets/bookmark_icon.png"); ?>">Bookmark</a>
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
                    <li class="active">
                        <a href="<?php echo base_url() ?>index.php/user"> Personal Info</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>index.php/user/borrowedCopies">Borrowed Books</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>index.php/user/catalogue">Search Books</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" >

            <div class="container-fluid" id="personalInfo">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style=" margin: 10px;
                                                padding: 10px;
                                                color: #428bca;">
                            Personal Info <small>User Details</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="well" id="divShow">
                    <label>Name: </label><b><?php echo $userInfo->first_name." ".$userInfo->last_name; ?></b><br>
                    
                    <label>Email Address: </label><b><?php echo $userInfo->email_id; ?></b><br>
                    <label>Address: </label><b><?php echo $userInfo->address; ?></b><br>
                    
                    <label>Occupation: </label><b><?php echo $userInfo->occupation; ?></b><br>
                    <label>Nationality: </label><b><?php echo $userInfo->nationality; ?></b><br>
                    
                    <label>Date Of Birth: </label><b><?php echo $userInfo->date_of_birth; ?></b><br>

                    <label>Gender: </label><b><?php echo $userInfo->gender; ?></b><br>
                    <label>Fines Incurred: </label><b><?php echo $userInfo->due_fine; ?></b><br>

                    <button class="btn btn-danger" style="margin-left: 950px;;" id="editButton">Edit Info</button>
                </div>
                
                <div id="divEdit" class="well"></div>
            </div>
            <!-- /.container-fluid -->

        </div>

        <div>

        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
 

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
