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
	
		$this->breadcrumbs->unshift(1, 'Berita', "administrator/posts");

		$this->breadcrumbs->unshift(2, 'Topik', "administrator/post_tags");

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push('Topik', '');

		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("administrator/users?per_page={$this->per_page}&query={$this->query}&role={$this->input->get('role')}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->tags->getAll(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Topik",
			'users' => $this->tags->getAll($this->per_page, $this->page)
		);

		$this->template->admin('tags', $this->data);
	}

}

/* End of file Tags.php */
/* Location: ./application/controllers/administrator/Tags.php */