<?php $this->load->helper('url'); ?>

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
    <link href="<?php echo base_url("assets/css/jquery-ui.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/select2.css"); ?>" rel="stylesheet"/>
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery-ui.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>
    <script>
        var dataEdition=[<?php $first=1; ?>
            <?php foreach ($editionName as $row) {
                if(!$first)echo ",";
                echo "{id:$row->isbn,text:'$row->edition_name'}";
                
                $first=0;
            } ?>]; 
        
            /*var copyCount=0;
            var newTableRow="<tr><td><h4>"+copyCount+".Select edition of the new Copy: </h4></td>"+
            "<td><input name=\"edition_name<?php echo $copyCount; ?>\" type=\"text\" id=\"selectEdition\" class=\"row col-lg-4\"><br></td>"+
            "</tr>";
            */
        $(document).ready(function() {
            var copyCount=1;
            
            $("#selectEdition1").select2({
                data:{
                     results: dataEdition
                }
            });
            $("#addAnotherCopy").click(function(){
                copyCount++;
                var newTableRow="<tr><td><h4>"+copyCount+".Select edition of the new Copy: </h4></td>"+
                "<td><input name=\"edition_name"+copyCount+"\" type=\"text\" id=\"selectEdition"+copyCount+"\" class=\"row col-lg-4\"><br></td>"+
                "</tr>";
                $("#table").append(newTableRow);

                $("#selectEdition"+copyCount).select2({
                    data:{
                         results: dataEdition
                    }
                });
                $("#hiddenCopyCount").attr("value",copyCount); 
            });

            $("#addNewEdition").click(function(){
                var divAddNewEdition="<form role=\"form\" method=\"POST\" action=\"<?php echo base_url('index.php/admin/insertNewEdition') ?>\">"+
                    "<input type=\"hidden\" name=\"bTitle\" value=\"<?php echo $bTitle ?>\">"+
                    "<input type=\"hidden\" name=\"bId\" value=\"<?php echo $bId ?>\">"+
                    "<table class=\"table table-striped\">"+
                        "<thead>"+
                            "<tr>" +
                                "<th class=\"row col-lg-2\">ISBN</th>"+
                                "<th class=\"row col-lg-2\">Edition Name</th>"+
                                "<th class=\"row col-lg-2\">Year of Publication</th>"+
                                "<th class=\"row col-lg-2\">Typeset</th>"+
                                "<th class=\"row col-lg-2\">Printer</th>"+
                            "</tr>"+
                        "</thead>"+
                        "<tr>"+
                            "<td><input style=\"margin-left:3px;\" name=\"isbn\" type=\"text\"  class=\"row col-lg-11\"></td>"+
                            "<td><input name=\"edition_name\" type=\"text\"  class=\"row col-lg-12\"></td>"+
                            "<td><input id=\"datePicker\" name=\"yearOfPub\" type=\"text\"  class=\"row col-lg-12\"></td>"+
                            "<td><input name=\"typeset\" type=\"text\"  class=\"row col-lg-12\"></td>"+
                            "<td><input name=\"printer\" type=\"text\"  class=\"row col-lg-12\"></td>"+
                        "</tr>"+
                    "</table>"+  
                    "<input style=\"margin:3px;\" type=\"submit\" class=\"btn btn-success\" value=\"Submit\">"+
                "</form>";

                $("#divAddNewEdition").html(divAddNewEdition);
                $("#datePicker").datepicker();
                
            });

        });


    </script>


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
                    <li class="active">
                        <a href="<?php echo base_url('index.php/admin/insert') ?>">Insert New Book</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/update') ?>">Update Book Information</a>
                    </li>
                    <li>
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

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style=" margin: 10px;
                                                padding: 10px;
                                                color: #428bca;">
                            Insert New Copy Of
                        </h1>
                        <ol class="breadcrumb">
                            <li >
                                <i class="fa fa-dashboard"></i>
                                <h3>Name: <?php echo $bTitle; ?></h3>
                            </li>
                        </ol>
                    </div>
                </div> 
                <div>To add new edition, click&nbsp<input style="margin:10px;" id="addNewEdition" type="button" class="btn btn-primary" value="Add new edition."></div>                   
                <div id="divAddNewEdition"></div>
                <div class="well">
                    <form role="form" method="POST" action="<?php echo base_url('index.php/admin/insertNewCopy') ?>">


                        
                        <input type="hidden" name="bId" value="<?php echo $bId; ?>">
                        <input type="hidden" name="copyCount" value="1" id="hiddenCopyCount">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr> 
                                    <th class="row col-lg-4"></th>
                                    <th class="row col-lg-4">Edition Name</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><h4>1.Select edition of the new Copy: </h4></td>
                                <td><input name="edition_name1" type="text" id="selectEdition1" class="row col-lg-4"><br></td>
                            </tr>
                        </table>  
                        

                        <input id="addAnotherCopy" type="button" class="btn btn-success" value="Add Another Copy">
                        <input type="submit" class="btn btn-success" value="Submit">

                    </form>
                </div> 

            </div>
            <!-- /.container-fluid -->

        </div>


    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    
    <!-- Bootstrap Core JavaScript -->


</body>

</html>
