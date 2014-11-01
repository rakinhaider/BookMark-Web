<?php 

class Login extends CI_Controller{

	function validate()
	{
		$login_email=$this->input->post('login_email');
		$login_password=$this->input->post('login_password');

		$this->load->model('users');
		$result = $this->users->checkValidLogin($login_email,$login_password);

		if(is_null($result))
		{
			
			redirect('home/login_failed');
		}
		else 
		{
			$data=array(
					"userName"=>$result->row()->first_name,
					"userId"=>$result->row()->user_id,
					"loggedIn"=>1
				);

			$this->session->set_userdata($data);
			redirect('home/login_success');
			//redirect('user');
		}
	}

	function logOut()
	{
		$data=array(
					"userName"=>"",
					"userId"=>"",
					"loggedIn"=>0
				);

		$this->session->set_userdata($data);
		redirect('home');
	}
}