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
		
	}

	function getAllCategory()
	{
		$q=$this->db->query("SELECT DISTINCT category FROM books WHERE category<>'';");
		//$q= $this->db->get('books');
		if($q->num_rows>0)
		{
			/*foreach ($q->result() as $row) {
				$data[]=$row;
			}*/
			return $q->result();
		}
		
	}

	function insert($postData)
	{
		$bTitle=$this->input->post('bTitle');
		$bCategory=$this->input->post('bCategory');

		$aName=$this->input->post('aName');
		$aAddress=$this->input->post('aAddress');
		$aContact=$this->input->post('aContact');
		$aEmail=$this->input->post('aEmail');
		$aWeb=$this->input->post('aWeb');

		$pName=$this->input->post('pName');
		$pAddress=$this->input->post('pAddress');
		$pContact=$this->input->post('pContact');
		$pEmail=$this->input->post('pEmail');
		$pWeb=$this->input->post('pWeb');


		$query="SELECT author_id FROM authors";
		$first=1;
		if($aName!='')
		{
			if($first==1){$first=0;$query=$query." WHERE ";}
			else $query=$query." AND ";
			$query=$query." name='".$aName."'";
		}
		if($aAddress!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query." address='".$aAddress."'";
		}
		if($aContact!='')
		{
			if($first==1){$first=0;}
			else $quer=$query." AND ";
			$query=$query." contact_no='".$aContact."'";
		}
		if($aEmail!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query." email='".$aEmail."'";
		}
		if($aWeb!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query." website='".$aWeb."'";
		}
		//var_dump($query);
		$data=$this->db->query($query);
		if($data->num_rows>0)$author_id=$data->row()->author_id;
		else
		{
			$insQuery="INSERT INTO  authors (`name` ,`address` ,`contact_no` ,`email` ,`website`) 
			VALUES ('$aName' , '$aAddress' , '$aContact' , '$aEmail' , '$aWeb');";
			//var_dump($insQuery);
			$q=$this->db->query($insQuery);
			$q=$this->db->query($query);
			$row=$q->row();
			$author_id=$row->author_id;
		}

		$query="SELECT publisher_id FROM publishers";
		$first=1;
		if($pName!='')
		{
			if($first==1){$first=0;$query=$query." WHERE ";}
			else $query=$query." AND ";
			$query=$query."name='".$pName."'";
		}
		if($pAddress!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query."address='".$pAddress."'";
		}
		if($pContact!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query."contact_no='".$pContact."'";
		}
		if($pEmail!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query."email='".$pEmail."'";
		}
		if($pWeb!='')
		{
			if($first==1){$first=0;}
			else $query=$query." AND ";
			$query=$query."website='".$pWeb."'";
		}
		//var_dump($query);
		$data=$this->db->query($query);
		//var_dump($data);
		if($data->num_rows>0)$publisher_id=$data->row()->publisher_id;
		else
		{
			$insQuery="INSERT INTO  publishers (`name` ,`address` ,`contact_no` ,`email` ,`website`) 
			VALUES ('$pName' , '$pAddress' , '$pContact' , '$pEmail' , '$pWeb');";
			//var_dump($insQuery);
			$q=$this->db->query($insQuery);
			$q=$this->db->query($query);
			$row=$q->row();
			$publisher_id=$row->publisher_id;
		}


        $q=$this->db->query("INSERT INTO books(title,publisher_id,category,total_copies,borrowed_copies,borrow_count) VALUES('$bTitle','$publisher_id','$bCategory',0,0,0)"); 
		$q=$this->db->query("SELECT max(book_id) as id FROM books WHERE title='$bTitle'");    
        $book_id=$q->row()->id;
        $q=$this->db->query("INSERT INTO  written_by (`book_id` ,`author_id`)
        	VALUES ('$book_id',  '$author_id')"); 

        $this->session->set_flashdata('bTitle', $bTitle);
        $this->session->set_flashdata('bId', $book_id);   
        
    } 
}
