<?php 

class Editions extends CI_Model {

	function getAllEditions()
	{
		$q=$this->db->query("SELECT DISTINCT isbn,edition_name FROM  `editions`");
		if($q->num_rows>0)
		{
			
			return $q->result();
		}
	}
	function getAllTypeset()
	{
		$q=$this->db->query("SELECT DISTINCT typeset FROM  `editions`");
		if($q->num_rows>0)
		{
			
			return $q->result();
		}
	}
	function getAllPrinter()
	{
		$q=$this->db->query("SELECT DISTINCT printer FROM  `editions`");
		if($q->num_rows>0)
		{
			return $q->result();
		}
	}

	function insertNewEdition(){
				
		$isbn=$this->input->post('isbn');
		$edition_name=$this->input->post('edition_name');
		$yearOfPub=$this->input->post('yearOfPub');
		$typeset=$this->input->post('typeset');
		$printer=$this->input->post('printer');

		$q=$this->db->query("INSERT INTO `editions` (`ISBN` ,`edition_name` ,`year_of_publication` ,`typeset` ,`printer`)
			VALUES ('$isbn', '$edition_name' , '$yearOfPub' , '$typeset' , '$printer');");

	}
}
