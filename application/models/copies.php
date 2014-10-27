<?php 

class Copies extends CI_Model {

	function insertNew($data){

		$bId=$this->input->post('bId');
		$copyCount=$this->input->post('copyCount');
		
		for ($i=1; $i <=$copyCount ; $i++ ){ 

			$postName="edition_name".$i;
			$isbn=$this->input->post($postName);

			$this->db->query("INSERT INTO  `copies` (`book_id` ,`isbn`)VALUES ($bId, $isbn);");
		}

		$this->db->query("UPDATE books SET total_copies=total_copies+$copyCount WHERE book_id=$bId;");
	}

	function getCopyIdToLend($book_id)
	{
		$q=$this->db->query("SELECT min(copy_id) as copytolend FROM copies WHERE book_id=$book_id AND is_borrowed=0;");
		$q=$q->row()->copytolend;
		return $q;
	}

}
