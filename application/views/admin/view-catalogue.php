
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

    <link href="<?php echo base_url("assets/css/select2.css"); ?>" rel="stylesheet"/>
    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/select2/select2.js"); ?>"></script>



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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Available Copies</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($record as $row): ?>
                        <tr>
                            <td><a href="<?php echo base_url('admin/bookDetails/').$row->book_id; ?>"><?php echo $row->title; ?></a></td>
                            <?php $authors=$this->db->query("SELECT book_id,a.author_id,a.name as authorname FROM authors a,written_by w WHERE  w.author_id=a.author_id AND w.book_id=$row->book_id;");  $authorName=''; 
                            ?>
                            <?php 
                            $first=1;
                            foreach ($authors->result() as $auth){
                                if($first!=1)$authorName=$authorName.",";
                                $authorName=$authorName."<a href=\"<?php echo base_url('admin/bookDetails/').$auth->author_id; ?>\">".$auth->authorname."</a>";
                                $first=0;
                            }
                            ?>
                            <td><?php echo $authorName; ?></td>
                            <td><a href="<?php echo base_url('admin/bookDetails/').$row->pub_id; ?>"><?php echo $row->pubname; ?></a></td>
                            <td><?php echo $row->available; ?></td>
                        </tr>
                        
                    <?php endforeach ?>




                    <!-- <tr>
                        <td>Sherlock Homes</td>
                        <td>Sir Aurthur Conan Doyel</td>
                        <td>London Publisher</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>2 Mistakes Of Life</td>
                        <td>Chetan Bhagat</td>
                        <td>Indian Publisher</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>3 Mistakes Of Life</td>
                        <td>Chetan Bhagat</td>
                        <td>Indian Publisher</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>4 Mistakes Of Life</td>
                        <td>Chetan Bhagat</td>
                        <td>Indian Publisher</td>
                        <td>3</td>
                    </tr> -->
                </tbody>

            </table>
            <?php echo $this->pagination->create_links(); ?>
        </div>

    </div>

    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


</body>

</html>
