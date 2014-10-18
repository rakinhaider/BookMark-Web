<?php 

class Copies extends CI_Model {

	function insertNew($data){

		$bTitle=$this->input->post('bTitle');;
		$bId=$this->input->post('bId');;

		$isbn=$this->input->post('isbn');
		$edition_name=$this->input->post('edition_name');
		$year_of_publication=$this->input->post('year_of_publication');
		$typeset=$this->input->post('typeset');
		$printer=$this->input->post('printer');
		
		$q=$this->db->query("SELECT * FROM editions WHERE isbn=".$isbn.";");


		if($q->num_rows==0)
			$this->db->query("INSERT INTO  editions (`ISBN` ,`edition_name` ,`year_of_publication` ,`typeset` ,`printer`) VALUES ('$isbn', '$edition_name' , '$year_of_publication' , '$typeset' , '$printer')");

		$this->db->query("INSERT INTO  `copies` (`book_id` ,`isbn`)VALUES ($bId, $isbn);");
	}
}
