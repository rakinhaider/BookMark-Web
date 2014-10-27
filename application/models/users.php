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
}