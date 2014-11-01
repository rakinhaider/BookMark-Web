<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		$userName = $this->session->userdata('userName');
		$user_id=$this->session->userdata('userId');
		
		$this->load->model('users');
		$userInfo=$this->users->getUserInfo($user_id);

		$data=array(
			'userName'=>$userName,
			'user_id'=>$user_id,
			'userInfo'=>$userInfo
			);

		$this->load->view('user/user_homepage',$data);


	}
	public function editInfo($user_id,$email_id)
	{
		//var_dump($_POST);
		$this->load->model('users');
		$email_id=urldecode($email_id);
		$this->users->editUserInfo($user_id,$email_id);
		redirect('user');
	}
	public function borrowedCopies(){
		//redirect('admin/catalogue');
		$userName = $this->session->userdata('userName');
		$user_id=$this->session->userdata('userId');
		$data=array(
			'userName'=>$userName,
			'user_id'=>$user_id
			);

		$this->load->view('user/borrowed-copies',$data);
	}

	public function catalogue(){
		$userName = $this->session->userdata('userName');
		$user_id=$this->session->userdata('userId');
		$data=array(
			'userName'=>$userName,
			'user_id'=>$user_id
			);

		$this->load->view('user/view-catalogue',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
