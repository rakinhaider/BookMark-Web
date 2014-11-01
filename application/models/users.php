<?php 

class Users extends CI_Model {

	function checkValidNewUsername($email_address)
	{
		$result=$this->db->query("SELECT * FROM users where email_id='".$email_address."'");
		if($result->num_rows()==1)return 0; 
	}

	function checkValidLogin($login_email,$login_password)
	{
		$result = $this->db->query("SELECT * FROM users WHERE email_id='".$login_email."' AND password=md5('".$login_password."');");
		if($result->num_rows()==1)return $result;
		//else return null;
	}

	function getAll()
	{
		$q=$this->db->query("SELECT * FROM users WHERE email_id<>'librarian@gmail.com'");
		return $q->result();
	}

	function getUserDetailsById($user_id)
	{
		$q=$this->db->query("SELECT * FROM users WHERE user_id=$user_id");
		return $q->row();
	}


	function updateFine($user_id,$fine){
		$this->db->query("UPDATE users SET due_fine=due_fine+$fine WHERE user_id=$user_id");
	}

	function clearFine($user_id){
		$this->db->query("UPDATE users SET due_fine=0 WHERE user_id=$user_id;");
	}
	function clearPayment($user_id,$amount){
		$this->db->query("UPDATE users SET due_fine=due_fine-$amount WHERE user_id=$user_id;");
	}

	function getUserInfo($user_id){
		$q=$this->db->query("SELECT * FROM users WHERE user_id=$user_id");
		return $q->row(); 
	}

	function editUserInfo($user_id,$email_id){
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		
		$address=$this->input->post('address');
		$occupation=$this->input->post('occupation');
		$nationality=$this->input->post('nationality');
		$date_of_birth=$this->input->post('date_of_birth');
		$gender=intval($this->input->post('gender'));

		if($gender==1)$gender="Male";
		else $gender="Female";

		$this->db->query("UPDATE users SET first_name='$first_name', last_name='$last_name',email_id='$email_id',address='$address',occupation='$occupation',nationality='$nationality',date_of_birth='$date_of_birth',gender='$gender' WHERE user_id=$user_id");
	}
}