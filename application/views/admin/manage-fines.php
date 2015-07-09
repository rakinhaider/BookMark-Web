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
    <link href="<?php echo base_url("assets/css/admin/catalogue.css"); ?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/css/select2.css"); ?>" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/dataTables.tableTools.css">
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/js/dataTables.tableTools.js"></script>
    <script src="//cdn.datatables.net/plug-ins/380cb78f450/integration/bootstrap/3/dataTables.bootstrap.js"></script> 


    <script type="text/javascript">
        $(document).ready(function(){
            


            function format ( d ) {
    // `d` is the original data object for the row
                var authors="";
                $.ajax({
                        type:"POST",
                        url:"<?php echo base_url(); ?>index.php/admin/getAuthorList",
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
                //console.log('hi');
                var title = $('#example thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );
            var table=$('#example').DataTable({
                "lengthMenu": [[4, 8, 12, -1], [4, 8, 12, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url(); ?>index.php/sqldata/fine",
                "columns": [
                                
                                { "data": "user" },
                                { "data": "email_id" },
                                { "data": "fine" },
                                {
                                    "class":          'details-control',
                                    "orderable":      false,
                                    "data":           null,
                                    "defaultContent": '<center><input  id="btnClearAll" type="button" class="btn btn-danger" value="Clear Fine" submit="<?php base_url() ?>admin/clearFine/"></center>'
                                },
                                {
                                    "class":          'details-control',
                                    "orderable":      false,
                                    "data":           null,
                                    "defaultContent": '<input style="width:60%;" id="amountRecieved" type="number"><input id="btnPaid" style="width:30%;float:right;" role="button" class="btn btn-primary" value="Paid">'
                                }
                            ],
                "oLanguage": {
                    "sEmptyTable": "<center>No users available</center>"
                },
                "createdRow": function ( row, data, index ) {
                    console.log();
                    var fine=Number(data['fine']);
                    if(fine==0){
                        $('td #btnClearAll', row).attr('disabled','disabled');
                        $('td #btnPaid', row).attr('disabled','disabled');
                        $('td #amountRecieved', row).attr('disabled','disabled');
                    }
                    
                },
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url() ?>assets/swf/copy_csv_xls_pdf.swf"
                },
                "order": [[ 2, "desc" ]]

            });
            $('#example tbody').on('click', 'td.details-control #btnClearAll', function () {

                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var data=row.data();
                window.location.href = "<?php echo base_url(); ?>"+"index.php/admin/clearFine/"+data.userId;
            } );

            $('#example tbody').on('click', 'td.details-control #btnPaid', function () {
                
                var input=$('#example tbody td.details-control #amountRecieved').val();
                if(!input)input=0;
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var data=row.data();

                window.location.href = "<?php echo base_url(); ?>"+"index.php/admin/clearPayment/"+data.userId+"/"+input;
            } );
            $("#example_filter").css( "float", "right" );
            $("#example_paginate").css( "float", "right" );

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
                <a class="navbar-brand" href="index.html"><img id="icon-image" src="<?php echo base_url("assets/bookmark_icon.png"); ?>">Bookmark</a>
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
                    <li class="active">
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
                <h1 class="page-header">
                    Manage Fines 
                </h1>
                <ol class="breadcrumb" id="breadcrumbdiv">
                    <li class="active">
                        View And Update Fines Incurred By Each User.
                    </li>
                </ol>
            </div>
        </div>


        <div style="margin:10px;">
            <table id="example" class="table table-striped table-hover table-bordered datatable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email Address</th>
                        <th>Fines</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
         
                <tfoot>
                    <tr>
                        <th>User</th>
                        <th>Email Address</th>
                        <th>Fines</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

    


</body>

</html>
