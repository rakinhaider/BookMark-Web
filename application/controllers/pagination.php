<?php 

class Pagination extends CI_Controller{


	function index(){
		$this->load->helper('url');
		$this->load->library('table');

		$this->load->library('pagination');
		$config['base_url']=base_url()."index.php/pagination/index";
		$config['total_rows']=$this->db->get('books')->num_rows();
		$config['per_page']=5;
		$config['num_links']=20;


		$config['full_tag_open'] = '<div class="pagination pagination-small pagination-centered"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li >';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = TRUE;
		$config['last_link'] = TRUE;

		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" class="table table-striped">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td><a href="#">',
                    'cell_end'            => '</a></td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td><a href="#">',
                    'cell_alt_end'        => '</a></td>',

                    'table_close'         => '</table>'
              );

			$this->table->set_template($tmpl);
		


		$this->pagination->initialize($config);
		$data['books']=$this->db->get('books', $config['per_page'],$this->uri->segment(3));

		//var_dump($config);
		$this->load->view('site-view',$data);
	}

	

}