
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


    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">


    <link href="<?php echo base_url("assets/css/admin/admin.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/admin/catalogue.css"); ?>" rel="stylesheet">
    <style type="text/css" class="init">

        td.details-control {
            background: url('<?php echo base_url() ?>assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('<?php echo base_url() ?>assets/images/details_close.png') no-repeat center center;
        }

    </style>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.dataTables.css" type="text/css" media="screen"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
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
                var title = $('#example thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );
            var table=$('#example').DataTable({
                "lengthMenu": [[4, 8, 12, -1], [4, 8, 12, "All"]],
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo base_url(); ?>index.php/sqldata",
                "columns": [
                                
                                { "data": "title" },
                                { "data": "pubname" },
                                { "data": "category" },
                                { "data": "available" },
                                {
                                    "class":          'details-control',
                                    "orderable":      false,
                                    "data":           null,
                                    "defaultContent": ''
                                },
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


</head>

<body>

    <div id="wrapper">


        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img id="icon-image" src="<?php echo base_url("assets/bookmark_icon.png"); ?>">Bookmark</a>
            </div>

            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                	<a href="#">Home</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">$userName<b class="caret"></b></a>
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
           
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li >
                        <a href="<?php echo base_url('index.php/admin') ?>"> Dashboard</a>
                    </li>
                    <li >
                        <a href="<?php echo base_url('index.php/admin/insert') ?>">Insert New Book</a>
                    </li>
                    <li >
                        <a href="<?php echo base_url('index.php/admin/update') ?>">Update Book Information</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/admin/lend') ?>">Lend Book</a>
                    </li>
                    <li >
                        <a href="<?php echo base_url('index.php/admin/fine') ?>"> Manage fines.</a>
                    </li>
                    <li class="active">
                        <a href="<?php echo base_url('index.php/admin/catalogue') ?>"> View Catalogue.</a>
                    </li>
                </ul>
            </div>

        </nav>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    View Catalogue 
                </h1>
                <ol class="breadcrumb" id="breadcrumbdiv">
                    <li class="active">
                        Details Of Available Books
                    </li>
                </ol>
            </div>
        </div>
    
        <div id="catalogue">
             <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Available</th>
                <th></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Available</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
        </div>

    </div>

    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
