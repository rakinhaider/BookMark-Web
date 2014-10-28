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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.dataTables.css" type="text/css" media="screen">
    
    <script type="text/javascript" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            //$("#example").dataTable();
            function format ( d ) {
    // `d` is the original data object for the row
                var authors="";
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url(); ?>index.php/admin/getAuthorList/",
                        data:{book_id:d.book_id},
                        async:false,
                        success:function(data){
                            authors=data;

                            //console.log(data);
                        }
                });

                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                    '<tr>'+
                        '<td>Title:</td>'+
                        '<td>'+d.title+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Publisher:</td>'+
                        '<td><a href=\"publisherDetails/'+d.publisher_id+'\">'+d.pubname+'</a></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Category:</td>'+
                        '<td>'+d.category+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td id=\"authrorList'+d.book_id+'\"">Category:</td>'+
                        '<td>'+authors+'</td>'+
                    '</tr>'+
                '</table>';
            }

            $('#example tfoot th').each( function () {
                var title = $('#example thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );
            var table=$('#example').DataTable({
                "lengthMenu": [[4, 8, 12, -1], [4, 8, 12, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url(); ?>index.php/sqldata/publishedByPublisher/"+"<?php echo $publisherInfo->publisher_id; ?>",
                "columns": [
                                
                                { "data": "title" },
                                { "data": "pubname" },
                                { "data": "category" }                                
                            ]

            });
         
            $('#example tbody').on('click', 'td.details-control', function () {
                


                var tr = $(this).closest('tr');
                var row = table.row( tr );

                
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data() ) ).show();
                    tr.addClass('shown');
                }
            } );

            table.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table
                        .column( colIdx )
                        .search( this.value )
                        .draw();
                } );
            } );
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
                    <li >
                        <a href="<?php echo base_url('index.php/admin') ?>"> Dashboard</a>
                    </li>
                    <li >
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
                            Authors Detailed Information <small>Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> <?php echo $publisherInfo->name; ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="well">

                    <label><b>Name:</b></label><i><?php echo $publisherInfo->name; ?></i><br>
                    <label><b>Nddress:</b></label><i><?php echo $publisherInfo->address; ?></i><br>
                    <label><b>Contact:</b></label><i><?php echo $publisherInfo->contact_no; ?></i><br>
                    <label><b>Email Address:</b></label><i><?php echo $publisherInfo->email; ?></i><br>
                    <label><b>Website:</b></label><i><a href="<?php echo prep_url($publisherInfo->website); ?>"><?php echo $publisherInfo->website; ?></a></i><br>
                </div> 

                <h4></h4>
                <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i><b> Books Published by <?php echo $publisherInfo->name; ?> :</b>
                            </li>
                        </ol>
                <div>

                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Publisher</th>
                                    <th>Category</th>
                                    
                                </tr>
                            </thead>
                     
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Publisher</th>
                                    <th>Category</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
