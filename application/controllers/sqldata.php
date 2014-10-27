<?php

class Sqldata extends CI_Controller{
    //var_dump($_GET);
    function index(){

        //var_dump($_GET);

        $q1 = "'";
        $q2 = '"';
        //$concat1 = "concat( ".$q2."<a href=".$q1."mailto:".$q2.", t.email, ".$q2.$q1.">".$q2.", t.firstName, ".$q2." ".$q2.", t.lastName, ".$q2."</a>".$q2." )";
        //$concat2 = "concat( ".$q2."<a href=".$q1.$q2.", d.websiteURL, ".$q2.$q1.">".$q2.", d.shortName, ".$q2."</a>".$q2." )";
        $aColumns = array( 'b.title', 'p.name', 'c.categoryname', 'b.total_copies-b.borrowed_copies','book_id');
        $sIndexColumn = "b.book_id";
        $sTable = "books b, publishers p, categories c";
        $sWhere = "WHERE b.publisher_id=p.publisher_id AND b.category=c.id";
     
        /* Database connection information removed */
        

        for ($i=0; $i <count($_GET['columns']) ; $i++) { 
            $config[$i]['data'] = $_GET['columns'][$i]['data'];
            $config[$i]['name'] = $_GET['columns'][$i]['name'];
            $config[$i]['searchable'] = $_GET['columns'][$i]['searchable'];
            $config[$i]['orderable'] = $_GET['columns'][$i]['orderable'];  
            $config[$i]['search'] = $_GET['columns'][$i]['search'];    
        }

        $gaSql['link'] = mysql_connect('localhost', 'root', '');
        $db_selected = mysql_select_db('term_project_database', $gaSql['link'] );
         
         
        $sLimit = "";
        if ( isset( $_GET['length'] ) )
        {
            $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['start']).", ".
                mysql_real_escape_string( $_GET['length'] );
        }
         
         
        if ( isset( $_GET['order'] ) )
        {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<count( $_GET['order'] ) ; $i++ )
            {
                $ordColumn=intval($_GET['order'][$i]['column']);
                $ordDir=$_GET['order'][$i]['dir'];
                if($config[$ordColumn]['orderable']=='true')
                    $sOrder .= $aColumns[ $ordColumn ]." ".mysql_real_escape_string( $ordDir ) .", ";
            }
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
         
        if ( $_GET['search'] != "" )
        {
            //$sWhere .= "WHERE (";
            $sWhere .= " AND (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['search']['value'] )."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
         
        /* Individual column filtering */
        /*for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
            {
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
            }
        }*/
        // var_dump("SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        //     FROM   $sTable
        //     $sWhere
        //     $sOrder
        //     $sLimit");
        $sQuery = "
            SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
            FROM   $sTable
            $sWhere
            $sOrder
            $sLimit
        ";
        $rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
         
        /* Data set length after filtering */
        $sQuery = "
            SELECT FOUND_ROWS()
        ";
        $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];
         
        /* Total data set length */
        $sQuery = "
            SELECT COUNT(".$sIndexColumn.")
            FROM   $sTable
        ";
        $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
         
        $output = array(
            "draw" => intval($_GET['draw']),
            "recordsTotal" => $iTotal,
            "recordsFiltered" => $iFilteredTotal,
            "data" => array()
        );
         
        while ( $aRow = mysql_fetch_array( $rResult ) )
        {
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ( $aColumns[$i] != ' ' )
                {
                    $row[] = $aRow[$i];
                }
            }
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}