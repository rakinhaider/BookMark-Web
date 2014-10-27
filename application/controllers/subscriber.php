<?php 
class Subscriber extends CI_Controller
{
	function index()
	{
		//echo "hi";
		$this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
        $tmpl = array('table_open' => '<table id="big_table" border="1" cellpadding="2" cellspacing="1" >');
        $this->table->set_template($tmpl);
 
        $this->table->set_heading('First Name', 'Last Name', 'Email');
 
        $this->load->view('subscriber_view');
	}

	function datatable()
    {
    	$this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
        $this->datatables->select('user_id,first_name,last_name,email_id')->unset_column('user_id')->from('users');
 
        echo $this->datatables->generate();
    }
}