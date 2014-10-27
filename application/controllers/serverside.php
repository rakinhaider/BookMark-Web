<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Serverside extends CI_Controller {
    function index(){
        /*
         * DataTables example server-side processing script.
         *
         * Please note that this script is intentionally extremely simply to show how
         * server-side processing can be implemented, and probably shouldn't be used as
         * the basis for a large complex system. It is suitable for simple use cases as
         * for learning.
         *
         * See http://datatables.net/usage/server-side for full details on the server-
         * side processing requirements of DataTables.
         *
         * @license MIT - http://datatables.net/license_mit
         */
         
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */
         
        // DB table to use
        $table = 'books';
        //$joinTable='publishers p';
         
        // Table's primary key
        $primaryKey = 'book_id';
         
        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'title', 'dt' => 0 ),
            array( 'db' => 'publisher_id',  'dt' => 1 ),
            array( 'db' => 'category',   'dt' => 2 ),
            array( 'db' => 'borrowed_copies',     'dt' => 3 ),
        );
         
        // SQL server connection information
        $sql_details = array(
            'user' => 'root',
            'pass' => '',
            'db'   => 'term_project_database',
            'host' => 'localhost'
        );
         
         
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */
         
        require( 'ssp.class.php' );
         
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
    }
    function sqlQuery()
    {

        $q=$q=$this->db->query("SELECT * FROM users WHERE email_id<>'librarian@gmail.com'");
        $output['draw']=0;
        $output['recordsTotal']=$q->num_rows();
        $output['recordsFiltered']=$q->num_rows();

        $i=0;
        foreach ($q->result() as $row ) {
            $data[]=$row;
        }
        $output['data']=$data;


        var_dump(json_encode($output));
        return json_encode($output);

    }
}