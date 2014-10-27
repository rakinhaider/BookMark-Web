<?php 

class Authors extends CI_Model {

	function getAll()
	{
		$q=$this->db->query("SELECT author_id as id, name as text FROM authors");
		//$q= $this->db->get('books');
		if($q->num_rows>0)
		{
			/*foreach ($q->result() as $row) {
				$data[]=$row;
			}*/
			return $q->result();
		}
		else return ($data=null);
	}

	function getAllAuthorForBook($book_id){
		$q=$this->db->query("SELECT author_id FROM written_by WHERE book_id=$book_id;");
		return $q->result();
	}

}