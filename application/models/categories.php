<?php 

class Categories extends CI_Model {
	function getAll(){
		$q=$this->db->query("SELECT id, categoryName as text FROM categories;");
		return $q->result();
	}
}
