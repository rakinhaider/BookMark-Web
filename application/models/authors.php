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
		//var_dump($book_id);
		$q=$this->db->query("SELECT a.author_id as authorId, name FROM written_by w,authors a WHERE w.book_id=$book_id AND a.author_id=w.author_id;");
		//var_dump($q->result());
		return $q->result();
	}
	function getAllAuthorForBookUpdate($book_id){
		//var_dump($book_id);
		$q=$this->db->query("SELECT a.author_id , name FROM written_by w,authors a WHERE w.book_id=$book_id AND a.author_id=w.author_id;");
		//var_dump($q->result());
		return $q->result();
	}

	function getAuthorInfoById($author_id){
		$q=$this->db->query("SELECT * FROM authors WHERE author_id=$author_id;");
		return $q->row();
	}

}