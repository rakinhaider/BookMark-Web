<?php 

class Publishers extends CI_Model {

	function getAll()
	{
		$q=$this->db->query("SELECT publisher_id as id, name as text FROM publishers");
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

	function getPublisherInfoById($publisher_id){
		$q=$this->db->query("SELECT *  FROM publishers WHERE publisher_id=$publisher_id;");
		//$q= $this->db->get('books');
		if($q->num_rows>0)
		{
			
			return $q->row();
		}
	}

}