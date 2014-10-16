<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$userInfo = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn==1)
		{
			redirect('home/login_success');
		}
 		else 
		{
			$this->load->view('home/homepage');
		}

	}

	public function registration_failed()
	{
		$error_msg = $this->session->flashdata('error');
		$data=array(
			'error_msg'=>$error_msg);
		$this->load->view('home/registration_failed',$data);
	}
	public function registration_success()
	{
		$this->load->view('home/registration_success');
	}

	public function login_failed()
	{
		$error_msg = $this->session->flashdata('error');
		$data=array(
			'error_msg'=>$error_msg);
		$this->load->view('home/login_failed',$data);
	}
	public function login_success()
	{
		//echo "hi";
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$data=array(
			'error_msg'=>"Please Log In.");
			$this->load->view('home/login_failed',$data);
		}
		else if($userName=="admin")
		{
			redirect('admin/');	
		}
		else
		{
			$data=array(
			'userName'=>$userName);

			$this->load->view('user/user_homepage',$data);
		}
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */