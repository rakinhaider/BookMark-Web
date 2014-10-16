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
}