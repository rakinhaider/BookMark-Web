<?php 

class Register extends CI_Controller{

	function validate()
	{
		$this->load->helper(array('form', 'url','email'));
		$this->load->library('form_validation');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$email_address=$this->input->post('email_address');
		$password=$this->input->post('password');
		$confirm_password=$this->input->post('confirm_password');
		$occupation=$this->input->post('occupation');
		$sex=$this->input->post('sex');
		$address=$this->input->post('address');
		$error=0;
		$error_msg="";
		
		$this->load->model('users');
		if($this->users->checkValidNewUsername($email_address))
		{
			$error=1;
			$error_msg="The email address is already used.<br>";
		}

		if (!valid_email($email_address))
		{
			$error=1;
			$error_msg=$error_msg."Invalid email address.<br>";
		}
		if($password!=$confirm_password)
		{
			$error=1;
			$error_msg=$error_msg."The confirm password doesnt match.<br>";
		}

		if($error)
		{
			$this->session->set_flashdata('error', $error_msg);
			redirect('home/registration_failed');
		}
		else 
		{
			$password=md5($password);
			$this->db->query("INSERT INTO  `users` (
					`first_name` ,
					`last_name` ,
					`date_of_birth` ,
					`gender` ,
					`nationality` ,
					`occupation` ,
					`address` ,
					`password` ,
					`email_id` ,
					`no_of_books_taken` ,
					`lifetime_books` ,
					`due_fine`
					)
					VALUES (
					  '$first_name',  '$last_name',  '0000-00-00',  '$sex',  'bangladeshi',  '$occupation',  '$address',  '$password',  '$email_address',  '0',  '0',  '0'
					); ");
			redirect('home/registration_success');

		}
	}
}