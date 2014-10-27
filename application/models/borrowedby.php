<?php 

class BorrowedBy extends CI_Model {

	function insertBorrowEntry(){

		$book_id=$this->input->post('book');
		$user_id=$this->input->post('user');
		$allowedDays=$this->input->post('allowedDays');
		
		$date=date("d.m.y");
		// var_dump($allowedDays);
		$toReturnDate  = mktime(0, 0, 0, date("m")  , date("d")+$allowedDays, date("Y"));
		$toReturnDate=gmdate("d.m.y", $toReturnDate);
		// var_dump($tomorrow);

		$this->load->model('copies');
		$copyIdToLend=$this->copies->getCopyIdToLend($book_id);

		/*var_dump($copyIdToLend);

		var_dump("INSERT INTO borrowed_by (user_id, copy_id, book_id, issue_date, to_return_date, returned_date, is_returned) VALUES ($user_id, $copyIdToLend, $book_id, '$date', '$toReturnDate', '00-00-0000', 0);");
*/

		$this->db->query("INSERT INTO borrowed_by (user_id, copy_id, book_id, issue_date, to_return_date, returned_date, is_returned) VALUES ($user_id, $copyIdToLend, $book_id, '$date', '$toReturnDate', '00-00-0000', 0);");

		$this->db->query("UPDATE copies SET is_borrowed=1 where copy_id=$copyIdToLend AND book_id=$book_id;");

		$data['copy_id']=$copyIdToLend;
		$data['user_id']=$user_id;
		$data['book_id']=$book_id;
		return $data;

	}

}
