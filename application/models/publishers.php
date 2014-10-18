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

}