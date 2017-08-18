<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_tags extends Admin_panel 
{
	public $data = array();

	public $per_page;

	public $page;

	public $query;

	public function __construct()
	{
		parent::__construct();
	
		$this->breadcrumbs->unshift(1, 'Topik', "administrator/post_tags");

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		
	}

}

/* End of file Tags.php */
/* Location: ./application/controllers/administrator/Tags.php */