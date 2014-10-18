<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$data=array(
			'userName'=>$userName);
			$this->load->view('admin/admin_homepage',$data);
		}

	}
	public function insert()
	{
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$this->load->model('authors');
			$this->load->model('publishers');

			$data['userName']=$userName;
			$data['authors']=$this->authors->getAll();
			$data['publishers']=$this->publishers->getAll();
			$this->load->view('admin/insert-book',$data);
		}
		

	}
	public function insertNewCopy()
	{
		$this->load->model('copies');
		$this->copies->insertNew($_POST);

		$this->load->view('admin/insertion-successful');		
	
	}
	public function insertNewBook()
	{
		$this->load->model('books');
		$this->books->insert($_POST);		

		$bTitle=$this->session->flashdata('bTitle');
        $book_id=$this->session->flashdata('bId' );  

		$data=array(
			'bTitle'=>$bTitle,
			'bId'=>$book_id
		);

		$this->load->view('admin/insert-copy',$data);

	}
	public function update()
	{
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$this->load->model('books');
			$books=$this->books->getAll();
			$data=array(
			'userName'=>$userName,
			'data'=>$books
			);
			$this->load->view('admin/update-book',$data);
		}
		

	}
	public function lend()
	{
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$data=array(
			'userName'=>$userName);
			$this->load->view('admin/lend-book');
		}	
		

	}
	public function fine()
	{
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$data=array(
			'userName'=>$userName);
			$this->load->view('admin/manage-fines');
		}
		

	}
	public function catalogue()
	{
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');

		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$this->load->model('books');
			$data['userName']=$userName;
			$data['record']=$this->books->getAll();
			$this->load->view('admin/view-catalogue',$data);
		}
		

	}
	
	public function error_access()
	{
		$data=array(
			'error_msg'=>"Please Log In.");
		$this->load->view('home/login_failed',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
