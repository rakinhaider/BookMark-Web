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

        var userDetails=[<?php $first=1; ?>
        <?php foreach ($users as $row) {
            if(!$first)echo ",";
            echo "{id:$row->user_id,first_name:'$row->first_name',last_name:'$row->last_name',date_of_birth:'$row->date_of_birth',gender:'$row->gender',nationality:'$row->nationality',occupation:'$row->occupation',address:'$row->address',email_id:'$row->email_id',no_of_books_taken:'$row->no_of_books_taken',due_fine:$row->due_fine}";
            echo "\n";
            
            $first=0;
        } ?>];

        var dataUser=[<?php $first=1; ?>
        <?php foreach ($users as $row) {
            if(!$first)echo ",";
            echo "{id:$row->user_id,text:'$row->email_id'}";

            
            $first=0;
        } ?>];

        var bookDetails=[<?php $first=1; ?>
        <?php foreach ($bookDetails as $row) {
            if(!$first)echo ",";
            echo "{id:$row->id,title:'$row->title',category:'$row->category',pubname:'$row->pubname',available:'$row->available'}";
            echo "\n";
            
            $first=0;
        } ?>];
        var dataBooks=[<?php $first=1; ?>
        <?php foreach ($books as $row) {
            if(!$first)echo ",";
            echo "{id:$row->id,text:'$row->text'}";
            
            $first=0;
        } ?>];
        $(document).ready(function() { 
            $("#User-selector").select2({
                data:{
                    results:dataUser
                }
            }); 

            $("#User-selector").change(function() {
                                
                var theID = $("#User-selector").select2('data').id;

                for (var i = 0; i <dataUser.length; i++) {
                    if(dataUser[i]["id"]==theID)
                    {
                        break;
                    }
                };

                console.log(dataUser[i]);

                var divUserDetails= "<h4>First Name:</h4>"+userDetails[i]["first_name"]+
                    "<h4>Last Name:</h4>"+userDetails[i]["last_name"]+
                    "<h4>Date Of Birth:</h4>"+userDetails[i]["date_of_birth"]+
                    "<h4>Gender:</h4>"+userDetails[i]["gender"]+
                    "<h4>Nationality:</h4>"+userDetails[i]["occupation"]+
                    "<h4>Occupation:</h4>"+userDetails[i]["address"]+
                    "<h4>Email Address:</h4>"+userDetails[i]["email_id"]+
                    "<h4>Books Taken:</h4>"+userDetails[i]["no_of_books_taken"]+
                    "<h4>Fines Incurred:</h4>"+userDetails[i]["due_fine"];

                $('#selectedUserDetails').html(divUserDetails);

            });

            $("#book-selector").select2({
                data:{
                    results:dataBooks
                }
            }); 

            $("#book-selector").change(function() {
            
                var theID = $("#book-selector").select2('data').id;
                console.log(theID);
                for (var i = 0; i <dataBooks.length; i++) {
                    console.log(dataBooks[i]["id"]);
                    console.log(theID);
                    
                    if(dataBooks[i]["id"]==theID)
                    {
                        break;
                    }
                };

                console.log(dataBooks[i]);

                var divBookDetails= "<h4>Title:</h4>"+bookDetails[i]["title"]+
                    "<h4>Category:</h4>"+bookDetails[i]["category"]+
                    "<h4>Publisher:</h4>"+bookDetails[i]["pubname"]+
                    "<h4>Copies Available:</h4>"+bookDetails[i]["available"];
                $('#selectedBookDetails').html(divBookDetails);

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


        <table>
            
        </table>

        <table class="table table-stiped">
            <thead>
                <tr>
                    <td class="col-lg-6" style="text-align:center;">Select A Book</td>
                    <td class="col-lg-8" style="text-align:center;">Select An User</td>
                </tr>
            </thead>
            <tr>
            <form role="form" method="POST" action="<?php echo base_url('index.php/admin/lendBookToUser') ?>">    
                <td>
                    <input name="book" type="text" id="book-selector" class="col-lg-12">
                </td>

                <td>
                    <input name="user" type="text" id="User-selector" class="col-lg-12">
                </td>
            </tr>
            <tr>
                <td>
                    <div id="selectedBookDetails" class="well"></div>


                </td>

                <td>
                    <div id="selectedUserDetails" class="well"></div>
                </td>
            </tr>
            
        </table>

        

        <label style="float:left;">Return Within </label>
        <input style="margin-left:10px;margin-right:10px;" type="number"   min="0" max="100" name="allowedDays" class="col-lg-1">
        <label style="float:left;"> Days From Today.</label>
        <center>
            <input  style="float:right;" type="submit" id="lendButton" class="btn btn-success" value="Lend Book">
        </center>
        </form>
    </div>

    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
