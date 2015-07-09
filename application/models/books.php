<?php 

class Books extends CI_Model {

	function getAll()
	{
		$q=$this->db->query("SELECT DISTINCT title,c.categoryName as category,a.name as authorname,p.name as pubname,total_copies-borrowed_copies as available from books b,authors a,written_by w,publishers p,categories c
			where b.book_id=w.book_id AND b.category=c.id AND p.publisher_id=b.publisher_id AND a.author_id=w.author_id");
		//$q= $this->db->get('books');
		if($q->num_rows>0)
		{
			/*foreach ($q->result() as $row) {
				$data[]=$row;
			}*/
			return $q->result();
		}
		
	}
	
	function getAllAvailableWithId()
	{
		$q=$this->db->query("SELECT DISTINCT b.book_id as id,title,c.categoryName as category,p.name as pubname,total_copies-borrowed_copies as available from books b,authors a,written_by w,publishers p,categories c
			where b.book_id=w.book_id AND b.category=c.id AND p.publisher_id=b.publisher_id AND (total_copies-borrowed_copies)>0;");
		//$q= $this->db->get('books');
		if($q->num_rows>0)
		{
			/*foreach ($q->result() as $row) {
				$data[]=$row;
			}*/
			return $q->result();
		}
		
	}
	function getAllCategory(){
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

	function getAllBookAndId(){
		$q="SELECT book_id as id, title as text FROM books;";
		$results=$this->db->query($q);
		return $results->result();
	}
	function getAllAvailableBookAndId(){
		$q="SELECT book_id as id, title as text FROM books WHERE (total_copies-borrowed_copies)>0;;";
		$results=$this->db->query($q);
		return $results->result();
	}
	function insert($postData){
		$bTitle=trim($this->input->post('bTitle'));
		$bCategory=$this->input->post('bCategory');

		$selectedAuthor=$this->input->post('selectedAuthor');
		$selectedPublisher=$this->input->post('selectedPublisher');

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

		if(!isset($selectedAuthor)){
			$insQuery="INSERT INTO  authors (`name` ,`address` ,`contact_no` ,`email` ,`website`) 
			VALUES ('$aName' , '$aAddress' , '$aContact' , '$aEmail' , '$aWeb');";
			$q=$this->db->query($insQuery);
			$query="SELECT author_id FROM authors";
			$first=1;
			if($aName!='')
			{
				if($first==1){$first=0;$query=$query." WHERE ";}
				else $query=$query." AND ";
				$query=$query."name='".$aName."'";
			}
			if($aAddress!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."address='".$aAddress."'";
			}
			if($aContact!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."contact_no='".$aContact."'";
			}
			if($aEmail!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."email='".$aEmail."'";
			}
			if($aWeb!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."website='".$aWeb."'";
			}
			$q=$this->db->query($query);
			$row=$q->row();
			$author_id=$row->author_id;
		}
		else $author_id=$selectedAuthor;


		if(!isset($selectedPublisher))
		{
			$insQuery="INSERT INTO  publishers (`name` ,`address` ,`contact_no` ,`email` ,`website`) 
			VALUES ('$pName' , '$pAddress' , '$pContact' , '$pEmail' , '$pWeb');";
			
			$q=$this->db->query($insQuery);
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
			$q=$this->db->query($query);
			$row=$q->row();
			$publisher_id=$row->publisher_id;
		}
		else $publisher_id=$selectedPublisher;

		$q=$this->db->query("INSERT INTO books(title,publisher_id,category,total_copies,borrowed_copies,borrow_count) VALUES('$bTitle','$publisher_id','$bCategory',0,0,0)"); 
		$q=$this->db->query("SELECT max(book_id) as id FROM books WHERE title='$bTitle' AND publisher_id=$publisher_id");    
        $book_id=$q->row()->id;
        $q=$this->db->query("INSERT INTO  written_by (`book_id` ,`author_id`)
        	VALUES ('$book_id',  '$author_id')"); 


        $data['bTitle']=$bTitle;
        $data['bid']=$book_id;
        $this->session->set_flashdata('bTitle', $bTitle);
        $this->session->set_flashdata('bId', $book_id);   
        return $data;
    } 

    function getBookDetailsById($book_id){
    	$q=$this->db->query("SELECT * FROM books WHERE book_id=$book_id;");
    	return $q->row();
    }

    function editBookById($data)
    {
    	// var_dump($_POST);
    	$book_id=$this->input->post('book_id');

    	$bTitle=trim($this->input->post('bTitle'));
    	$catoryId=$this->input->post('bCategory');
    	$selectedAuthor=$this->input->post('selectedAuthor');
    	$selectedAuthorList=explode(",", $selectedAuthor);
    	$selectedAuthorCount=count($selectedAuthorList);
    	// var_dump($selectedAuthorList);
    	// var_dump($selectedAuthorCount);
    	$newAuthorCount=$this->input->post('newAuthorCount');
		$selectedPublisher=$this->input->post('selectedPublisher');

		for ($i=1; $i <=$newAuthorCount ; $i++) { 
			$aName[$i]=$this->input->post('aName'.$i);
			$aAddress[$i]=$this->input->post('aAddress'.$i);
			$aContact[$i]=$this->input->post('aContact'.$i);
			$aEmail[$i]=$this->input->post('aEmail'.$i);
			$aWeb[$i]=$this->input->post('aWeb'.$i);

			$insQuery="INSERT INTO  authors (`name` ,`address` ,`contact_no` ,`email` ,`website`) 
			VALUES ('$aName[$i]' , '$aAddress[$i]' , '$aContact[$i]' , '$aEmail[$i]' , '$aWeb[$i]');";
			$q=$this->db->query($insQuery);

			$query="SELECT author_id FROM authors";
			$first=1;
			if($aName[$i]!='')
			{
				if($first==1){$first=0;$query=$query." WHERE ";}
				else $query=$query." AND ";
				$query=$query."name='".$aName[$i]."'";
			}
			if($aAddress[$i]!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."address='".$aAddress[$i]."'";
			}
			if($aContact[$i]!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."contact_no='".$aContact[$i]."'";
			}
			if($aEmail[$i]!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."email='".$aEmail[$i]."'";
			}
			if($aWeb[$i]!='')
			{
				if($first==1){$first=0;}
				else $query=$query." AND ";
				$query=$query."website='".$aWeb[$i]."'";
			}
			// var_dump($query);
			$q=$this->db->query($query);
			$row=$q->row();
			$author_id=$row->author_id;


			$this->db->query("INSERT INTO written_by VALUES($book_id,$author_id);");
		}

		/*var_dump($aName);
		var_dump($aAddress);
		var_dump($aContact);
		var_dump($aEmail);
		var_dump($aWeb);*/

		
		$this->db->query("DELETE FROM written_by WHERE book_id=$book_id;");

		for ($i=0; $i <$selectedAuthorCount ; $i++) { 
			$this->db->query("INSERT INTO written_by VALUES($book_id,$selectedAuthorList[$i]);");
		}

		if(!isset($selectedPublisher))
		{
			$pName=$this->input->post('pName');
			$pAddress=$this->input->post('pAddress');
			$pContact=$this->input->post('pContact');
			$pEmail=$this->input->post('pEmail');
			$pWeb=$this->input->post('pWeb');

			$insQuery="INSERT INTO  publishers (`name` ,`address` ,`contact_no` ,`email` ,`website`) 
			VALUES ('$pName' , '$pAddress' , '$pContact' , '$pEmail' , '$pWeb');";
			
			$q=$this->db->query($insQuery);
			
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
			$q=$this->db->query($query);
			$row=$q->row();
			$publisher_id=$row->publisher_id;
		}
		else $publisher_id=$selectedPublisher;

		$this->db->query("UPDATE books SET title='$bTitle', publisher_id=$publisher_id, category=$catoryId WHERE book_id=$book_id;");
    }

    function getAllByOffsetLimit($offset,$limit)
	{
		$endIndex=$offset+$limit;
		//var_dump($endIndex);
		$q=$this->db->query("SELECT DISTINCT b.book_id,title,c.categoryName as category,b.publisher_id as pub_id,p.name as pubname,total_copies-borrowed_copies as available from books b,publishers p,categories c
			where b.category=c.id AND p.publisher_id=b.publisher_id LIMIT $offset,$endIndex");
		//$q= $this->db->get('books');
		if($q->num_rows>0)
		{
			return $q->result();
		}
		
	}
	function getCatalogueCount()
	{
		
		$q=$this->db->query("SELECT DISTINCT title,c.categoryName as category,a.name as authorname,p.name as pubname,total_copies-borrowed_copies as available from books b,authors a,written_by w,publishers p,categories c
			where b.book_id=w.book_id AND b.category=c.id AND p.publisher_id=b.publisher_id AND a.author_id=w.author_id");
		//$q= $this->db->get('books');
		return $q->num_rows();
		
	}


}
