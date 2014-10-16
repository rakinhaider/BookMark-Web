<?php 

class Books extends CI_Model {

	function getAll()
	{
		$q=$this->db->query("SELECT DISTINCT title,a.name as authorname,p.name as pubname,total_copies-borrowed_copies as available from books b,authors a,written_by w,publishers p
			where b.book_id=w.book_id AND p.publisher_id=b.publisher_id AND a.author_id=w.author_id");
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

	function insert($postData)
	{
		$title=$postData->title;
		$publisher_id=$postData->publisher_id;
		$category=$postData->category;

        $q=$this->db->query("INSERT INTO books(title,publisher_id,category,tot
al_copies,borrowed_copies,borrow_count) VALUES('$title','$publisher_id','$category',0,0,0)");     } }
