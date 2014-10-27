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
	public function showInsertNewCopy($bTitle,$book_id){
		$bTitle=urldecode($bTitle);
		$this->load->model('editions');

		$editionName=$this->editions->getAllEditions();

		$data=array(
			'bTitle'=>$bTitle,
			'bId'=>$book_id,
			'editionName'=>$editionName
		);		
		$this->load->view('admin/insert-copy',$data);
	}
	public function insertNewCopy()
	{
		//var_dump($_POST);
		$this->load->model('copies');
		$this->copies->insertNew($_POST);

		$this->load->view('admin/insertion-successful');		
	
	}
	public function insertNewEdition()
	{
		$this->load->model('editions');
		$this->editions->insertNewEdition();

		$bTitle=$this->input->post('bTitle');
		$book_id=$this->input->post('bId');

		$editionName=$this->editions->getAllEditions();

		/*$data=array(
			'bTitle'=>$bTitle,
			'bId'=>$book_id,
			'editionName'=>$editionName
		);		
		$this->load->view('admin/insert-copy',$data);	*/	
		redirect('admin/showInsertNewCopy/'.$bTitle."/".$book_id);
	
	}
	public function insertNewBook()
	{
		$this->load->model('books');
		$this->books->insert($_POST);	
		$bTitle=$this->session->flashdata('bTitle');
        $book_id=$this->session->flashdata('bId' );  	
		redirect('admin/showInsertNewCopy/'.$bTitle."/".$book_id);

	}
	public function update()
	{
		$userName = $this->session->userdata('userName');
		$loggedIn= $this->session->userdata('loggedIn');
		$userId= $this->session->userdata('userId');
		//var_dump($userName);
		if($loggedIn!=1)
		{
			$this->error_access();
		}
		else if($userName=="admin")
		{
			$this->load->model('books');
			$books=$this->books->getAllBookAndId();
			$data=array(
			'userName'=>$userName,
			'books'=>$books
			);
			$this->load->view('admin/update-book',$data);
		}
	}

	public function showEditBookDetails($bTitle,$book_id)
	{
		//var_dump($bTitle);


		$this->load->model('books');
		$bookDetails=$this->books->getBookDetailsById($book_id);

		$this->load->model('authors');
		$this->load->model('publishers');
		$this->load->model('categories');
		
		$data['bookDetails']=$bookDetails;
		$data['authors']=$this->authors->getAll();
		$data['publishers']=$this->publishers->getAll();
		$data['written_by']=$this->authors->getAllAuthorForBook($book_id);
		$data['categories']=$this->categories->getAll();	
		//var_dump($data['categories']);
		$this->load->view('admin/edit-book-details',$data);

	}
	public function showRemoveCopy($bTitle,$book_id)
	{
		var_dump($bTitle);


		$this->load->model('copies');
		$this->load->library('pagination');
		$config['base_url']=base_url()."index.php/admin/showRemoveCopy/";
		$config['total_rows']=$this->copies->getCopyCount($book_id);
		$config['per_page']=4;
		$config['num_links']=20;


		$config['full_tag_open'] = '<center><ul class="pagination pagination-small pagination-centered">';
		$config['full_tag_close'] = '</ul></center>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = true;
		$config['last_link'] = true;


		$this->pagination->initialize($config);
		$offset=$this->uri->segment(3);
		if($offset=='')$offset=0;
		$data['record']=$this->books->getAllByOffsetLimit($offset,$config['per_page']);
		
		//var_dump($data['total_rows']);
		$this->load->view('admin/view-catalogue',$data);
	}

	public function editBookDetails(){
		$this->load->model('books');
		$this->books->editBookById($_POST);
		redirect('admin/editSuccess');
	}
	public function editSuccess()
	{
		$this->load->view('admin/edit-success');	
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
			$this->load->model('users');
			$this->load->model('books');

			$users=$this->users->getAll();
			$books=$this->books->getAllAvailableBookAndId();
			$bookDetails=$this->books->getAllAvailableWithId();
			//var_dump(json_encode($bookDetails));
			$data=array(
			'userName'=>$userName,
			'users'=>$users,
			'books'=>$books,
			'bookDetails'=>$bookDetails
			);
			//var_dump($bookDetails);
			$this->load->view('admin/lend-book',$data);
		}	
		

	}
	public function lendBookToUser()
	{
		//var_dump($_POST);
		$this->load->model('borrowedby');
		$data=$this->borrowedby->insertBorrowEntry();

		$userId= $this->session->set_flashdata('data',$data);

		redirect('admin/lendSuccessful/');
	}
	public function lendSuccessful()
	{

		$data= $this->session->flashdata('data');
		$this->load->model('users');
		$this->load->model('books');

		$userDetails=$this->users->getUserDetailsById($data['user_id']);
		$bookDetails=$this->books->getBookDetailsById($data['book_id']);

		$data['userDetails']=$userDetails;
		$data['bookDetails']=$bookDetails;

		$this->load->view('admin/lend-successful',$data);
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


	public function dataForCatalogue()
	{
		//var_dump($_GET);
		$table = 'books';
		$primaryKey = 'book_id';
		$columns = array(
            array( 'db' => 'title', 'dt' => 0 ),
            array( 'db' => 'name',  'dt' => 1 ),
            array( 'db' => 'categoryName',   'dt' => 2 ),
            array( 'db' => 'available',     'dt' => 3 )
        );
         
        $sql_details = array(
            'user' => 'root',
            'pass' => '',
            'db'   => 'term_project_database',
            'host' => 'localhost'
        );
        
        require( 'ssp1.class.php' );
        //var_dump($_GET);
        echo json_encode(
            SSPCatalogue::simple( $_GET, $sql_details, $table, $primaryKey ,$columns)
        );
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
			
			$this->load->library('pagination');
			$config['base_url']=base_url()."index.php/admin/catalogue/";
			$config['total_rows']=$this->books->getCatalogueCount();
			$config['per_page']=4;
			$config['num_links']=20;


			$config['full_tag_open'] = '<center><ul class="pagination pagination-small pagination-centered">';
			$config['full_tag_close'] = '</ul></center>';
			$config['prev_link'] = '&lt; Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next &gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['first_link'] = true;
			$config['last_link'] = true;


			$this->pagination->initialize($config);
			$offset=$this->uri->segment(3);
			if($offset=='')$offset=0;
			$data['record']=$this->books->getAllByOffsetLimit($offset,$config['per_page']);
			
			//var_dump($data['total_rows']);
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
